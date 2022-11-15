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
  <body>
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
                    <div class="col-md-3 my-3 mx-4 rounded align-items-center">
                     <div class="card h-100 mx-2" style="width: 18em;margin-bottom: -1em;">
                       <form action="{{ route('addtocart') }}" method="post">
                        @csrf
                        <div class="card rounded" style="width: 18em;height: 18em;">
                        @if($product->image !== "" && file_exists('images/' . $product->image))
                          <img src="/product_images/{{$product->image}}" alt="Error, image could not be loaded"/>
                        @else
                          <img src="/product_images/default.png" alt="Error, image could not be loaded"/>
                        @endif
                      </div>
                          <a href="{{route('productdetail', ['product' => $product->id])}}" class="" style="text-decoration: none; color: inherit;">
                          <div class="card-body d-flex flex-column">
                            <input type="hidden" name="productId" value="{{$product->id}}">
                            <h5 class="card-title" name="product">{{$product->name}} <p>€{{number_format($product->price / 100, 2, ',', '.')}}<p></h5>
                            <div class="flex overflow-hidden" style="height: 4em;">
                              <p class="card-text" name="description">{{$product->description}}</p>
                            </div>
                        </div>
                      </a>
                      <div class="flex overflow-hidden" style="height: 3em;">
                       <ul class="list-group list-group-flush">
                         <li class="list-group-item flex">
                          @if(count($product->categories) < 1)
                            <p class="flex">
                            No relevant categories found.
                          </p>
                          @else
                          <div class="flex row">
                            <p class="flex">
                            @foreach ($product->categories as $category)
                              {{$category->name}}
                            @endforeach
                          </p>
                          </div>
                          @endif
                         </li>
                       </ul>
                     </div>
                     @if($product->quantity > 0)
                       <div class="card-footer mt-auto my-12">
                         <div class="input-group mb-3">
                         <input class="form-control" aria-describedby="basic-addon1" type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
                         <div class="input-group-append">
                         <input class="btn btn-outline-secondary" type="submit" value="Buy">
                         </div>
                       </div>
                       </div>
                       @else
                        <div class="card-footer mt-auto my-12">
                          <div class="input-group mb-3">
                            <p>This product is not in stock.</p>
                          </div>
                        </div>
                       @endif
                     </form>
                     </div>
                   </div>
                     @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
  @endsection
