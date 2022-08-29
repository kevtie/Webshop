<?php
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
?>
  @extends('layouts.app')
  @section('content')
  <style>
  .card.h-100:hover{
    transform: scale(1.1);
  }
  .card.h-100{
    transition: transform 0.2s ease;
    box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);

    margin-bottom: 1.5em;
  }

  </style>
  <header>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card pb-3">
                  <div class="card-header d-flex justify-content-between align-items-center">Products
                    <div class="page-item">
                      @if(ProductController::getProduct() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ProductController::getProduct()->links()}}
                      @endif
                    </div>
                  </div>
                  <div class="card-deck row">
                    @foreach (ProductController::getProduct() as $product)
                    @if($product->quantity > 0)
                    <div class="col-md-3 my-3 mx-4">
                     <div class="card h-100 mx-2" style="width: 18em;margin-bottom: -1em">
                       <form action="{{ route('addtocart') }}" method="post">
                        @csrf
                        <a href="products/details/{{$product->id}}" class="" style="text-decoration: none; color: inherit;">
                          <img src="{{asset($product->image)}}" alt="Error, image could not be loaded"></img>
                          <div class="card-body d-flex flex-column">
                            <input type="hidden" name="productId" value="{{$product->id}}">
                            <h5 class="card-title" name="product">{{$product->name}}</h5>
                            <div class="overflow-hidden">
                              <p class="card-text" name="description">{{$product->description}}</p>
                            </div>
                        </div>
                      </a>
                      <div class="flex">
                       <ul class="list-group list-group-flush">
                         <li class="list-group-item">
                          @if(count($product->categories) < 1)
                            No relevant categories found.
                          @else
                          <div class="flex overflow-hidden row">
                            @foreach ($product->categories as $category)
                              {{$category->name}}
                            @endforeach
                          </div>
                          @endif
                         </li>
                       </ul>
                     </div>
                       <div class="card-footer mt-auto my-12">
                         <div class="input-group mb-3">
                         <input class="form-control" aria-describedby="basic-addon1" type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                         <div class="input-group-append">
                         <input class="btn btn-outline-secondary" type="submit" value="Buy">
                         </div>
                       </div>
                       </div>
                     </form>
                     </div>
                   </div>
                     @endif
                     @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
  </header>
  @endsection
