<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class Customer extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
  public function products(){
    return $this->belongsToMany(Product::class, 'orders');
  }
  public function orderHistory(){
    return $this->hasMany(OrderHistory::class);
  }

}
