<?php
use App\Http\Controllers\CategoryController;
 ?>
@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<body>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-9">
              <div class="flex card row pb-3">
                  <div class="card-header d-flex justify-content-between align-items-center">Category update selection
                    @if(CategoryController::paginateCategories() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                      {{CategoryController::paginateCategories()->links()}}
                    @endif
                  </div>
                  @forelse(CategoryController::paginateCategories() as $category)
                  <script>
                    function toggle(d) {
                      var x = document.getElementById(d);
                      console.log(d, x);
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      } else {
                        x.style.display = "none";
                      }
                    }
                  </script>
                  <div class="card">
                    <div class="flex m-2">
                      <h3>{{$category->name}}</h3><br>
                      <h5>{{$category->description}}</h5><br>
                    </div>
                    <button class="btn btn-outline-secondary my-2" onclick="toggle('categoryForm{{$category->id}}')">Toggle edit form</button>
                    <div id="categoryForm{{$category->id}}" style="display: none;">
                      <form method="post" action="{{route('updateCategory')}}">
                        @csrf
                        <input type="hidden" name="categoryId" value="{{$category->id}}">
                        <input class="form-control mt-2" type="text" name="categoryName" value="{{$category->name}}" placeholder="Name">
                        <textarea class='form-control' name='categoryDescription'>{{$category->description}}</textarea>
                        <input class="btn btn-outline-secondary mt-2" type="submit">
                      </form>
                      <form method="post" action="{{route('deleteCategory')}}">
                        @csrf
                        <input type="hidden" name="categoryId" value="{{$category->id}}">
                        <input class="btn btn-outline-danger" type="submit" value="Delete">
                      </form>
                    </div>
                  </div>
                  @empty
                    <p><h4>There are no categories!</h4></p>
                  @endforelse
              </div>
          </div>
      </div>
  </div>
</body>
@endsection
