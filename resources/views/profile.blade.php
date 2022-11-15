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
                  <div class="card p-2">
                    <h3>{{request()->name}}</h3>
                    @if(request()->name === Auth::user()->name)
                    <h5>Change Email</h5>
                      <form>
                        <input class="form-control" type="text" name="newEmail" value="{{ProfileController::getCurrentUser()->Email}}">
                        <input class="btn btn-outline-secondary mt-2" type="submit">
                      </form>
                    @else
                      <h5>Email:</h5>
                      <p>{{ProfileController::getCurrentUser()->Email}}</p>
                    @endif
                    <h3>Balance:</h3>
                    <p>€{{ProfileController::getCurrentUser()->balance / 100}}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
@endsection
