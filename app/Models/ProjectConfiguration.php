<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'company_name',
        'whatsapp_number',
        'sms_number',
        'email_sender',
        'email_sender_name',
        'additional_settings',
    ];

    protected $casts = [
        'additional_settings' => 'array',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Helper Methods
    public function updateSetting(string $key, $value): void
    {
        $settings = $this->additional_settings ?? [];
        $settings[$key] = $value;
        $this->update(['additional_settings' => $settings]);
    }

    public function getSetting(string $key, $default = null)
    {
        return $this->additional_settings[$key] ?? $default;
    }

    public function hasWhatsApp(): bool
    {
        return !empty($this->whatsapp_number);
    }

    public function hasSMS(): bool
    {
        return !empty($this->sms_number);
    }

    public function hasEmail(): bool
    {
        return !empty($this->email_sender);
    }
}
