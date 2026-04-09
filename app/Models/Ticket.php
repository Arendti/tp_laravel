<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

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
        return $this->belongsToMany(User::class, 'ticket_assignements');
    }

    public function devs(): Collection 
    {
        return $this->belongsToMany(User::class, 'ticket_assignements')->where('role', 'Dev')->get();
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Time_Entry::class);
    }

    public function included(): string
    {
        return ($this->ticket_included) ? "included" : "chargeable";
    }

    public function length(): int
    {
        $sum = 0;
        foreach ($this->entries as $entry){
            $sum += $entry->length; 
        }
        return $sum;
    }
 }
