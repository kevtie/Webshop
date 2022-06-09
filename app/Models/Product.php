<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

class Product extends Model
{
    use HasFactory;
    public function categories(){
      return $this->belongsToMany(Category::class);
    }
    public function customers(){
      return $this->belongsToMany(Customer::class, 'orders');
    }
    public function orders(){
      return $this->belongsToMany(Order::class)->withPivot('order_quantity', 'product_id');
    }

}
