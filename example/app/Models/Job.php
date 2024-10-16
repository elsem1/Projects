<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Job extends Authenticatable {
    use HasFactory;
    protected $table = 'job_listings';

    protected $fillable =  // Deze velden mogen worden veranderd
    [
        'title',
        'salary',
        'job_description',
        'employer_id'
        ];

    // Ipv $fillable kan je ook guarded []; gebruiken, dit doet het tegenovergestelde; alleen de velden die je uitgesloten wilt hebben.

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
    public function tags() 
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}