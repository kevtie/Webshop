<?php
use App\Http\Controllers\AdminController;
 ?>
@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

</script>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="flex card row pb-3">
                <div class="card-header d-flex justify-content-between align-items-center">Dashboard</div>
                @if(Auth::user()->role_id === 1)
                <div class="card-deck flex row mx-1 my-3">
                  <div class="card col-md-12 justify-content-center">
                  <h1 class="p-2">Add a new product</h1>
                  @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                  @endif
                  <form method="post" action="{{route('newproduct')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="text" id="productName" name="productName" placeholder="Name...*" >
                    <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Description...*" ></textarea>
                    <input class="form-control" type="file" id="" name="productImage">
                    <input class="form-control" type="number" step=".01" id="productPrice" name="productPrice" placeholder="Price...*" >
                    <input class="form-control" type="number" id="productQuantity" name="productQuantity" placeholder="Quantity...*" >
                    <p>Categories:</p>
                    {!!AdminController::categoryCheckbox()!!}
                    <input class="btn btn-outline-secondary mt-3" id="submit" type="submit" ><p id="warning">Not all required fields are filled in!</p>
                  </form>
                </div>
                <div class="d-flex card row mt-3 ms-1 col-md-6">
                  <h1 class="p-2">Add category</h1>
                  <form method="post" action="{{route('addCategory')}}">
                    @csrf
                    <input class="form-control" type="text" name="categoryName" placeholder="Name...*">
                    <textarea class="form-control" name="categoryDescription" placeholder="Description...*" ></textarea>
                    <input class="btn btn-outline-secondary mt-3" type="submit">
                  </form>
                </div>
                <div class="d-flex card row mt-3 col-md-6">
                  <h1 class="">Edit categories</h1>
                  <div class="">
                    <a class="btn btn-primary" href="{{route('editCategory')}}">Go to page</a>
                  </div>
                </div>
                </div>
                @endif
                <div class="card-deck flex row mx-3">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
