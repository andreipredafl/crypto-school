<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function index()
    {
        return Inertia::render('lessons/Index');
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
