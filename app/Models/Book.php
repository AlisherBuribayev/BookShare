<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function cart_book(){
        return $this->hasMany(Ticket::class);
    }
    
    public function like(){
        return $this->hasMany(Like::class);
    }
}