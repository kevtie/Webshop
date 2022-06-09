<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CustomerController;

class OrderHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function customers(){
      return $this->belongsTo(Customer::class);
    }
}
