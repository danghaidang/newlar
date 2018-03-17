<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorePage extends Model
{
    //
    protected  $table = 'store_page';
    //protected  $fillable = ['id', 'name', 'title', 'logo', 'count','used'];
    protected $guarded = ['id'];
    public $timestamps = true;
    public function news() {

    }
}
