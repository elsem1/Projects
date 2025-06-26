<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'content',
        'status_id',
        'created_by',
        'handled_by'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_ticket');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
