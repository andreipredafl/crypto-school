<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function index()
    {
        
        $lessons = Lesson::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->through(fn ($lesson) => [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'slug' => $lesson->slug,
                'description' => $lesson->description,
                'thumbnail_url' => $lesson->thumbnail_url,
                'duration' => $lesson->duration,
                'formatted_duration' => $lesson->formatted_duration
            ]);
            
        return Inertia::render('lessons/Index', [
            'lessons' => $lessons,
        ]);
    }

    public function show($lesson)
    {
        $lesson = [
            'title' => 'Lesson Title 1',
            'content' => 'This is the content of the lesson.',
            'slug' => $lesson,
        ];
        
        return Inertia::render('lessons/Show', [
            'lesson' => $lesson,
        ]);
    }
}
