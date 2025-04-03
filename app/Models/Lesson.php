<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'thumbnail_url',
        'duration',
        'is_published',
        'popup_seconds_before_end',
        'popup_type',
        'popup_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'duration' => 'integer',
        'popup_seconds_before_end' => 'integer',
    ];

    public function popup(): MorphTo
    {
        return $this->morphTo();
    }

    public function getFormattedDurationAttribute(): string
    {
        if (empty($this->duration)) {
            return '00:00';
        }

        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;

        return sprintf('%02d:%02d', $minutes, $seconds);
    }
    
    public function getPopupTypeLabelAttribute(): ?string
    {
        return match ($this->popup_type) {
            \App\Models\Quiz::class => 'quiz',
            \App\Models\CallToAction::class => 'cta',
            default => null,
        };
    }
}