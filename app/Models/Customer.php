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

  const role_admin_id    = 1;
  const role_mod_id      = 2;
  const role_customer_id = 3;
  protected $guarded = ['id'];
  protected $hidden = ['password', 'remember_token',];

  public function products(){
    return $this->belongsToMany(Product::class, 'orders');
  }

  public function orderHistory(){
    return $this->hasMany(OrderHistory::class);
  }

}
