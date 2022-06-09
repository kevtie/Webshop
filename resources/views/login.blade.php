<html>
  <!DOCTYPE html>
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
      <form method="post" action="{{ route('auth') }}">
        {{csrf_field()}}
        <input type="text" name="name" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login" value="Login">
      </form>
    </body>
