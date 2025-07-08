<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $status_id
 * @property int $created_by
 * @property int $handled_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\User $handler
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Note> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reply> $replies
 * @property-read int|null $replies_count
 * @method static \Database\Factories\TicketFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereHandledBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
