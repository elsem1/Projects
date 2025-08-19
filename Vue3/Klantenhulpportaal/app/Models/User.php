<?php

namespace App\Models;



use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'is_admin',
        'password'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }
    public function handledTickets()
    {
        return $this->hasMany(Ticket::class, 'handled_by');
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
