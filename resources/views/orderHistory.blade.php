<?php
use App\Http\Controllers\OrderHistoryController;
use App\Models\OrderHistory;
?>
@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-12 col-md-8 ">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  Order History
                  <div class="page-item">
                  @if(OrderHistoryController::getOrderHistory() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{OrderHistoryController::getOrderHistory()->links()}}
                  @endif
                </div>
                </div>
                <div class="card-body">
                  <div class="col-12 col-sm-12 col-md-12">

                    @forelse(OrderHistoryController::getOrderHistory() as $history)
                      {!!OrderHistoryController::tableGen($history->orderInfo)!!}
                    @empty
                      <p>You have no previous purchases.</p>
                    @endforelse
                  <div class="d-flex justify-content-center">
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
