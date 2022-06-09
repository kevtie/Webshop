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
                  {{ProductDetailController::getProductPage()->name}}
                  {{ProductDetailController::getProductPage()->description}}
                </div>
            </div>
        </div>
    </div>
</div>
</header>
@endsection
