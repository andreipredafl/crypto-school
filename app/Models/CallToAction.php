<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CallToAction extends Model
{
    use HasFactory;
    
    protected $table = 'call_to_actions';

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_url',
        'button_text_color',
        'button_bg_color',
    ];

    public function lesson(): MorphOne
    {
        return $this->morphOne(Lesson::class, 'popup');
    }
}