<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'path',
        'user_id',
        'article_id'
        ];

        public function user() {
            return $this->belongsTo(User::class);

        }

        public function article() {
            return $this->belongsTo(Ad::class);
        }
}
