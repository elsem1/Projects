<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $ticket_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket $ticket
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\NoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Note whereUserId($value)
 * @mixin \Eloquent
 */
class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'content',
        'user_id',
        'ticket_id',
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
