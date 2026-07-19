<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
        'title',
        'description',
        'category_id',
        'image'
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }


    public function category() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
