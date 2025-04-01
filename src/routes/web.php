<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

// Route::get('/', function () {return view('index');});

Route::get('/lesson', [LessonController::class, 'entrypoint'])->name('lesson.entrypoint');
Route::post('/lesson/{lesson_id}/answer/{question_no}', [LessonController::class, 'answer'])->name('lesson.answer');
