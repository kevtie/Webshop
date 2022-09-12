<?php
use App\Http\Controllers\ProfileController;
 ?>
@extends('layouts.app')
@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card pb-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{request()->name}}'s profile</div>
                <div class="card-deck row mx-3">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
