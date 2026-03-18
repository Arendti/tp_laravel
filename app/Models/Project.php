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
        "start_date",
        "end_date"
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function devs(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "project_assignement");
    }
    
    public function tickets(): HasMany
    {
        return $this->hasMany(Tickets::class);
    }
}
