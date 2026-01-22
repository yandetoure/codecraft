<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'changed_by_id',
        'old_status',
        'new_status',
        'notes',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_id');
    }

    // Accessors
    public function getOldStatusLabelAttribute(): ?string
    {
        if (!$this->old_status)
            return null;
        return config('codecraft.project_statuses')[$this->old_status] ?? $this->old_status;
    }

    public function getNewStatusLabelAttribute(): string
    {
        return config('codecraft.project_statuses')[$this->new_status] ?? $this->new_status;
    }
}
