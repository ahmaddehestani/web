<?php

namespace App\Models;

use App\Enums\TableTicketFieldDepartmentEnum;
use App\Enums\TableTicketFieldPriorityEnum;
use App\Enums\TableTicketFieldStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'department',
        'user_id',
        'closed_by',
        'status',
        'key',
        'priority',
    ];
    protected $casts    = [
        'status'     => TableTicketFieldStatusEnum::class,
        'priority'   => TableTicketFieldPriorityEnum::class,
        'department' => TableTicketFieldDepartmentEnum::class,
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(function (Ticket $ticket) {
            $ticket->key = floor(time() - 999999999);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
