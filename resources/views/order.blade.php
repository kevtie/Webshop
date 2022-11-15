<?php
  use App\Http\Controllers\OrderController;
  use App\Models\Order;
  use App\Models\Product;
  use App\Models\Customer;
  $total = 0;
 ?>
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Cart</div>
        <div class="card-body">
          <div class="card-deck row">
            @forelse(OrderController::checkOrder() as $product)
            <div class="card h-100 my-2">
              <div class="card-header row">
                <?php $total += ($product->price * $product->pivot->order_quantity);?>
                <form class="d-flex align-items-center" method="post" action="{{ route('removefromcart') }}">
                  <div class="col-12 col-md-6">
                    <h5 class="card-title">{{$product->name}}</h5></div>
                    @csrf
                    <div class="col-12 col-md-6">
                      <input type="hidden" name="delete" value="{{$product->id}}">
                      <input class="btn btn-primary float-end" type="submit" value="X"></div>
                    </form>
                  </div>
                  <div class="card-body d-flex align-items-center">
                    <div class="col-12 col-md-4">Price</div>
                    <div class="col-12 col-md-4"></div>
                    <div class="col-12 col-md-4">Quantity</div>
                  </div>
                  <div class="card-body d-flex align-items-center">
                    <div class="col-12 col-md-4">€{{$product->price}}</div>
                    <div class="col-12 col-md-4">X</div>
                    <div class="col-12 col-md-4">{{$product->pivot->order_quantity}}</div>
                  </div>
                </div>
                @empty
                <table>
                  <tr><td>This cart is empty</td></tr>
                </table>
              </div>
              @endforelse

              @if(count(OrderController::checkOrder()) > 0)
              <h3>€{{$total}}</h3>
              <form method="post" action="{{ route('pay') }}">
                @csrf
                <input class="btn btn-primary" type="submit" name="order" value="Buy">
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
