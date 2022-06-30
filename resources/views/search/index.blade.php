<?php
use App\Http\Controllers\SearchController;
 ?>

<html lang="en">
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
                  <form action="" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-group mb-3">
                            <input type="text" class="form-control"   placeholder="Search employee" id="search">
                            <div class="input-group-prepend">
                              <input type="submit" class="btn btn-outline-secondary">
                            </div>
                            <div>
                              @forelse(SearchController::showSearch() as $result)



                              @empty

                              @endforelse
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
