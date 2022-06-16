<?php
use App\Http\Controllers\ProductDetailController;
 ?>
@extends('layouts.app')

@section('content')
<header>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card pb-3">
                <div class="card-header d-flex justify-content-between align-items-center">Product details
                </div>
                <div class="card-deck row">
                  {{$product->name}} <br>
                  {{$product->description}} <br>
                  <div class="row d-flex justify-content-center align-items-center">
                    @forelse($categories->pluck('name') as $category)
                      <div class="badge badge-pill bg-secondary justify-content-center row" style="width: auto;">{{$category}}                      </div>
                    @empty
                      No relevant categories found!
                    @endforelse
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
@endsection
