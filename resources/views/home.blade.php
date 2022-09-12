<?php
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
?>
@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="/assets/computer.jpg" class="d-block w-100 h-75" alt="...">
              </div>
              <div class="carousel-item">
                <img src="/assets/books.jpg" class="d-block w-100 h-75" alt="...">
              </div>
              <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            <div class="card">
              <div class="card-header">Home</div>
          </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
