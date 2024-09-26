<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Job extends Authenticatable {
    use HasFactory;
    protected $table = 'job_listings';

    protected $fillable = 
    [
        'title',
        'salary'
        ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function tags() 
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}