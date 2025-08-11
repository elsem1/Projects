<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public function getStatusNameAttribute()
    {
        return DB::table('ticket_statuses')->where('id', $this->status_id)->value('name');
    }

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
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
