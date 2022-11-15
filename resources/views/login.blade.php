@extends('layouts.app')
@section('content')
    <body>

      @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      @endif

      @if(count($errors) > 0)
        <div>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-deck row">
            <div class="col-md-3 my-3 mx-4 rounded align-items-center">
              <div class="card row justify-content-center" style="width: 24em;height: 18em">
                <h3>Login</h3>
                <div class="row">
                <form method="post" action="{{ route('auth') }}">
                  @csrf
                  <input class="form-control" type="text" name="name" placeholder="Username">
                  <input class="form-control" type="password" name="password" placeholder="Password">
                  <input class="btn btn-outline-primary" type="submit" name="login" value="Login">
                </form>
              </div>
            </div>
              <div class="card row justify-content-center" style="width: 24em;height: 20em">
                <h3>Register</h3>
                <div class="row">
                <form method="post" action="{{ route('register') }}">
                  @csrf
                  <input class="form-control" type="text" name="registerName" placeholder="Username">
                  <input class="form-control" type="email" name="registerEmail" placeholder="Email@email.com">
                  <input class="form-control" type="password" name="registerPassword" placeholder="Password">
                  <input class="btn btn-outline-primary" type="submit" name="registerButton" value="Register">
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </body>
    @endsection
