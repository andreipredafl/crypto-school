<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'quiz_id',
        'text',
        'is_correct',
    ];
    
    protected $casts = [
        'is_correct' => 'boolean',
    ];
    
    protected $hidden = [
        'is_correct',
        'created_at',
        'updated_at',
    ];
    
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}