<?php
use App\Http\Controllers\ProfileController;
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
                <div class="card-header d-flex justify-content-between align-items-center">{{request()->name}}'s profile</div>
                @if(Auth::user()->role_id === 1)
                <div class="card-deck flex row mx-1 my-3">
                  <h1>Add a new product</h1>
                  @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                  @endif
                  <form method="post" action="{{route('newproduct')}}" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="text" id="productName" name="productName" placeholder="Name..." >
                    <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Description..." ></textarea>
                    <input class="form-control" type="file" id="" name="productImage">
                    <input class="form-control" type="number" id="productPrice" name="productPrice" placeholder="Price..." >
                    <input class="form-control" type="number" id="productQuantity" name="productQuantity" placeholder="Quantity..." >
                    <p>Categories:</p>
                    {!!ProfileController::categoryCheckbox()!!}
                    <input class="btn btn-outline-secondary" id="submit" type="submit" ><p id="warning">Not all required fields are filled in!</p>
                  </form>
                </div>
                @endif
                <div class="card-deck flex row mx-3">
                  <p>fffffffffff</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
