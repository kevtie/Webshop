<?php
use App\Http\Controllers\ProductDetailController;
 ?>
@extends('layouts.app')

@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-3">
      <div class="card mt-1" style="width: auto; height: auto;">
        @if($product->image !== "" && file_exists('images/' . $product->image))
        <img src="/product_images/{{$product->image}}" alt="Error, image could not be loaded"></img>
        @else
        <img src="/product_images/default.png" alt="Error, image could not be loaded"></img>
        @endif
      </div>
      </div>
        <div class="col-md-9">
          <div class="card row d-flex pb-3">
            <div class="card-header d-flex justify-content-between align-items-center">Product details</div>
            <div class="card-deck flex row mx-3">
              <div class="my-4 pe-5">
              @if($errors->any())
              <h4>{{$errors->first()}}</h4>
              @endif
              @if(Auth::user()->role_id !== 1)
              <h1 class="flex row">{{$product->name}}</h1><br><br>
              <h4>Description</h4>
              <p>{{$product->description}}</p>
              <div class="d-flex row">
                <h4>Categories</h4>
                  <div class="btn-group">
                    @forelse($categories->pluck('name') as $category)
                    <form action="{{route('searchcat')}}" method="post">
                      @csrf
                      <input class="form-control" type="hidden" value="{{$category}}" name="searchCat">
                      <input class="form-control" type="hidden" value="{{request()->product->id}}" name="productUrl">
                      <input class="form-control btn btn-outline-primary btn-sm" type="submit" value="{{$category}}" style="width: auto;">
                    </form>
                    @empty
                      No relevant categories found!
                    @endforelse
                  </div>
              </div>
              <div>
                <h4>Quantity</h4>
                <form action="{{ route('addtocart') }}" method="post">
                  	@csrf
                    <input type="hidden" name="productId" value="{{$product->id}}">
                    @if($product->quantity > 0)
                      <div class="input-group mb-3">
                        <input class="form-control" aria-describedby="basic-addon1" type="number" name="quantity" value="1" min="1" max="{{$product->quantity / 100}}">
                        <div class="input-group-append">
                          <input class="btn btn-outline-secondary" type="submit" value="Buy">
                        </div>
                      </div>
                    @else
                     <p>This product is not in stock.</p>
                    @endif
                </form>
              </div>
              @else
              <form action="{{route('updateproduct')}}" method='post' enctype="multipart/form-data">
                @csrf
                <input class='form-control' value='{{request()->product->id}}' type='hidden' name='productUrl'>
                <h5>Product Name</h5>
                <input class='form-control' value='{{request()->product->name}}' type='text' name='productName'>
                <h5 class="mt-2">Description</h5>
                <textarea class='form-control' name='productDescription'>{{request()->product->description}}</textarea>
                <h5 class="mt-2">Price</h5>
                <input class='form-control' value='{{request()->product->price / 100}}' step=".01" type='number' name='productPrice'>
                <h5 class="mt-2">Quantity</h5>
                <input class='form-control' value='{{request()->product->quantity}}' type='number' name='productQuantity'>
                <h4 class="mt-2">Categories</h4>
                <p>{!!ProductDetailController::updateCheckBox(request()->product->id)!!}</p>
                <input class='form-control' type="file" name="productImage">
                <input class="btn btn-outline-secondary mt-2" type='submit'>
              </form>
              <form action="{{route('deleteProduct')}}" method="post">
                @csrf
                <input class="form-control" type="hidden" value="{{request()->product->id}}" name="productUrl">
                <input class="btn btn-outline-danger" type='submit' value="Delete">
              </form>
              @endif
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</body>
@endsection
