<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Project extends Model
{    
    protected $table = "projects";
    protected $fillable = [
        "client_id",
        "project_title",
        "project_description",
        "included_hours",
        "hourly_rate",
        "start_date",
        "end_date"
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function isAssigned(): bool
    {
        return $this->belongsToMany(User::class, "project_assignements")->exists();
    }
    
    public function devs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "project_assignements");
    }
    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function length(): int
    {
        $sum = 0;
        foreach ($this->tickets as $ticket){
            $sum += $ticket->length(); 
        }
        return $sum;
    }
}
