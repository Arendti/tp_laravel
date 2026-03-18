<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time_Entry extends Model
{
    protected $table = "time_entries";
    protected $fillable = [
        "user_id",
        "ticket_id",
        "comment",
        "length"
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
