@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>
                <div class="card-body">
                  <?php
                  use Illuminate\Support\Facades\DB;
                  use App\Models\Product;

                  $customers = DB::table('customers')->get();

                    $products = Product::with('categories')->get();
                    foreach ($products as $product) {
                       echo $product->name . '<br>';
                      foreach ($product->categories as $category){
                        echo '( ' . $category->name . ' )<br>';
                      }
                       echo $product->description . '<br><br>';
                    }

                  ?>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
