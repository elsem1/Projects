<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReplyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reply whereUserId($value)
 * @mixin \Eloquent
 */
class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ticket_id',
        'user_id',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
