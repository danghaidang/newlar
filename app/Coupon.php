<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected  $table = 'coupon';
    //protected  $fillable = ['off', 'verify', 'used', 'textoff', 'code'];
    protected $guarded = ['id'];
    public $timestamps = true;
    public function news() {

    }
}
