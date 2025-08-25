<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    protected $table = 'categories';

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'category_ticket');
    }
}
