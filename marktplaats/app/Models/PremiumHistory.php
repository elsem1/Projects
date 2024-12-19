<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PremiumHistory extends Model
{
    use HasFactory;

    protected $table = 'premium_history';


    protected $fillable = [
        'ad_id',
        'purchased_at',
        'duration_days',
    ];

    protected $dates = [
        'purchased_at',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
