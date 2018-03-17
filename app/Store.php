<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    //
    protected  $table = 'store';
    //protected  $fillable = ['id', 'name', 'title', 'logo', 'count','used'];
    protected $guarded = ['id'];
    public $timestamps = true;
    public function news() {

    }
}
