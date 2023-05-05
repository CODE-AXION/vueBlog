<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','meta_title','meta_description','description','category_id','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

