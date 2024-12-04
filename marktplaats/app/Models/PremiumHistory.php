<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumHistory extends Model
{
    use HasFactory;

    // The table associated with the model (optional if the table name follows convention)
    protected $table = 'premium_history';

    // The attributes that are mass assignable
    protected $fillable = [
        'ad_id',
        'purchased_at',
        'duration_days',
    ];

    // Define the relationship to the Ad model
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
