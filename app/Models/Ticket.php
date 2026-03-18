<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $table = "tickets";
    protected $fillable = [
        "project_id",
        "ticket_title",
        "ticket_description",
        "ticket_status",
        "ticket_priority",
        "ticket_included"
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_assignement');
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Time_Entry::class);
    }
}
