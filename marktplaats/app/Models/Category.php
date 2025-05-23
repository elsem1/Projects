<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $table = 'categories';
    public function ads()
    {
        return $this->belongsToMany(Ad::class, 'ad_category');
    }
}

