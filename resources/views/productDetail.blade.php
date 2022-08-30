<?php
use App\Http\Controllers\ProductDetailController;
 ?>
@extends('layouts.app')

@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card pb-3">
                <div class="card-header d-flex justify-content-between align-items-center">Product details
                </div>
                <div class="card-deck row mx-3">
                  <img src="/product_images/{{$product->image}}" alt="Error, image could not be loaded"></img>
                  {{$product->name}} <br>
                  {{$product->description}} <br>
                  <div class="row d-flex justify-content-end align-items-end">
                    <div class="card row overflow-auto" style="width: 14rem;">
                      <div class="card-body btn-group">
                        @forelse($categories->pluck('name') as $category)
                          <div class="d-flex"><a class="btn btn-outline-primary btn-sm" href="" style="width: auto;">{{$category}}</a></div>
                        @empty
                          No relevant categories found!
                        @endforelse
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
