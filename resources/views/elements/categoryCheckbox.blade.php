
  <div class='btn-group mt-3' role='group'>
    @foreach($categories as $key=>$category)
    <input class='btn-check' type='checkbox' name='category[]' id='{{$category->name}}' value='{{$category->id}}'>
    <label class='btn btn-outline-primary' for='{{$category->name}}'>{{$category->name}}</label>
      @if($key % 5 === 0 && $key !== 0)
        </div><br>
        <div class='btn-group mt-3' role='group'>
      @endif
    @endforeach
  </div><br>
