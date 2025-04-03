<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function correctAnswer()
    {
        return $this->answers()->where('is_correct', true)->first();
    }
    
    public function lesson(): MorphOne
    {
        return $this->morphOne(Lesson::class, 'popup');
    }
}