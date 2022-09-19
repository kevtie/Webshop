@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

  $(function(){
    $("#newPass, #cNewPass").on("keyup", function () {
      var fst=$("#newPass").val();
      var sec=$("#cNewPass").val();
      if (String(sec) !== String(fst)) {
        $('#submit').prop('disabled', true);
        return true;
      }else{
        $('#submit').prop('disabled', false);
        return true;
      }
    })
  })


</script>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="flex card row pb-3">
                <div class="card-header">Settings</div>
                  <div class="card" class="mb-3" style="width: 18rem;">
                    <h1>Reset password</h1>
                    <form action="{{route('reset')}}" method="post">
                      <input class="form-control" type="password" placeholder="Current password">
                      <input class="form-control" id="newPass" type="password" placeholder="New password">
                      <input class="form-control" id="cNewPass" type="password" placeholder="Confirm new Password">
                      <input class="btn btn-primary" id="submit" type="submit" disabled>
                    </form>
                  </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
