@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

  $(function(){
    $("#newPass, #cNewPass").on("keyup", function () {
      var fst=$("#newPass").val();
      var sec=$("#cNewPass").val();
if (fst.length === 0 || sec.length === 0){
  if (sec != fst) {
    $('#submit').prop('disabled', true);
    $("#warning").prop('hidden', false);
    return true;
  }
  }else{
    $('#submit').prop('disabled', false);
    $("#warning").prop('hidden', true);
    return true;
}

    })
  })

</script>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="flex card row pb-3 align-items-center">
                <div class="card-header">Settings</div>
                  <div class="flex card mt-3 ms-1" style="width: 20em;">
                    <div class="card-header"><h2>Reset password</h2></div>
                      @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                      @endif
                    <form action="{{route('reset')}}" method="post">
                      @csrf
                      <input class="form-control mt-3" name="current" type="password" placeholder="Current password">
                      <input class="form-control mt-3" name="new" id="newPass" type="password" placeholder="New password">
                      <input class="form-control mt-3" name="cNew" id="cNewPass" type="password" placeholder="Confirm new Password">
                      <input class="btn btn-primary mt-3" id="submit" type="submit" disabled><p id="warning">Fields are not the same!</p>
                    </form>
                  </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
