<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'body',
        'user_id',
        'premium'
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function comments()
        {
            return $this->hasMany(Comment::class);
        }

        public function images()
        {
            return $this->hasMany(Image::class);
        }

        public function image()
{
    return $this->hasOne(Image::class);
}


        public function categories()
        {
            return $this->belongsToMany(Category::class, 'article_category');
        }
}
