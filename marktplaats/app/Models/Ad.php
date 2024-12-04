<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'ask',
        'views',
       

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ad_category');
    }

    public function views() 
    { 
        return $this->hasMany(View::class); 
    }

    public function premiumHistory()
    {
        return $this->hasMany(PremiumHistory::class);
    }

    public function isPremium()
    {
        $lastPremiumPurchase = $this->premiumHistory()->latest()->first();
        if ($lastPremiumPurchase) {
            $expiryDate = $lastPremiumPurchase->purchased_at->addDays($lastPremiumPurchase->duration_days);
            return $expiryDate > now(); 
        }
        return false;
    }
}


