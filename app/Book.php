<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    protected $table = "books";
    protected $fillable = ['name', 'price', 'quantity', 'author_id', 'category_id', 'image', 'introduce'];
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
}
