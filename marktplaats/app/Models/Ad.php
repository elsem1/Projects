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
        return $this->premiumHistory() // Kijkt of een ad premium heeft
            ->where('purchased_at', '<=', now())
            ->where(function ($query) {
                $query->whereRaw('DATE_ADD(purchased_at, INTERVAL duration_days DAY) > ?', [now()]);
            })
            ->exists();
    }

    public function scopePremium($query) // Filter dat kijkt welke ads premium zijn door te kijken wanneer de premium verloopt
    {
        return $query->whereHas('premiumHistory', function ($query) {
            $query->where('purchased_at', '<=', now())
                ->whereRaw('DATE_ADD(purchased_at, INTERVAL duration_days DAY) > ?', [now()]);
        })
            ->orderBy('latest_premium_date', 'desc')
            ->withExpression('latest_premium_date', function ($query) {
                return $query->select('purchased_at')
                    ->from('premium_history')
                    ->whereColumn('ad_id', 'ads.id')
                    ->latest()
                    ->limit(1);
            });
    }


    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'ask' => $this->ask,
        ];
    }
}


