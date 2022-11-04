<?php
use App\Http\Controllers\SearchController;
 ?>

 @extends('layouts.app')
 @section('content')
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
   <div class="container">
      <div class="row mt-5">
         <div class="col-md-12">
           <div class="card">
              <div class="card-body">
                  <form action="{{ route('showSearch') }}" method="post">
                    @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." name="search" id="search">
                            <div class="input-group-prepend">
                              <input type="submit" class="btn btn-outline-secondary">
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                  <div>
                  <table class="table table-hover">
                    <th></th>
                    <th><b>Name</b></th>
                    <th><b>Description</b></th>
                    <th></th>
                  @forelse($search_results as $search)
                  <div>
                      <tr>
                        <td>
                          @if($search->image !== "" && file_exists('images/' . $search->image))
                          <img src="/search_icon/{{$search->image}}">
                          @else
                          <img src="/search_icon/default.png">
                          @endif
                        </td>
                        <td>{{$search->name}}</td>
                        <td>{{Str::limit($search->description, 50)}}</td>
                        <td><a href="products/details/{{$search->id}}" class="btn btn-outline-secondary">Go to page</a></td>
                      </tr>
                  </div>
                  @empty
                  <div>
                    No results were found!
                  </div>
                  @endforelse
                </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
@endsection
