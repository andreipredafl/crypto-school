<?php

namespace App\Http\Controllers;

use App\Models\CallToAction;
use App\Models\Lesson;
use App\Models\Quiz;
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
                'formatted_duration' => $lesson->formatted_duration,
                'popup_type' => $lesson->popup_type_label,
            ]);
            
        return Inertia::render('lessons/Index', [
            'lessons' => $lessons,
        ]);
    }
    
    public function show($slug)
    {
        $lesson = Lesson::where('slug', $slug)->firstOrFail();
        
        if(!$lesson->is_published) {
            return redirect()->route('lessons.index')
                ->with('error', 'This lesson is not available yet');
        }
        
        $lessonData = [
            'id' => $lesson->id,
            'title' => $lesson->title,
            'slug' => $lesson->slug,
            'description' => $lesson->description,
            'video_url' => $lesson->video_url,
            'thumbnail_url' => $lesson->thumbnail_url,
            'duration' => $lesson->duration,
            'formatted_duration' => $lesson->formatted_duration,
            'popup_seconds_before_end' => $lesson->popup_seconds_before_end,
            'popup_type' => $lesson->popup_type_label,
        ];
        
        if ($lesson->popup) {
            $lessonData['popup_type'] = $lesson->popup_type === Quiz::class ? 'quiz' : 'cta';
            
            if ($lessonData['popup_type'] === 'quiz') {
                $lessonData['popup_data'] = [
                    'question' => $lesson->popup->question,
                    'answers' => $lesson->popup->answers()->take(4)->get(['id', 'text'])
                ];
            } else {
                $lessonData['popup_data'] = [
                    'title' => $lesson->popup->title,
                    'description' => $lesson->popup->description,
                    'button' => [
                        'text' => $lesson->popup->button_text,
                        'url' => $lesson->popup->button_url,
                        'color' => $lesson->popup->button_text_color ?? '#FFFFFF',
                        'bgColor' => $lesson->popup->button_bg_color ?? '#10B981',
                    ],
                ];
            }
        }
        
        // return $lessonData;
        
        return Inertia::render('lessons/Show', [
            'lesson' => $lessonData,
        ]);
    }
}
