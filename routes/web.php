<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

// Route::get('/', function () {return view('index');});

// lesson
Route::get('/lesson', [LessonController::class, 'entrypoint'])->name('lesson.entrypoint');
Route::get('/lesson/word', [LessonController::class, 'wordQuestion'])->name('lesson.word');
Route::post('/lesson/word/answer', [LessonController::class, 'answer'])->name('lesson.answer');
Route::get('/lesson/word-rev', [LessonController::class, 'wordQuestionRev'])->name('lesson.word.rev');
Route::post('/lesson/word-rev/answer', [LessonController::class, 'answerRev'])->name('lesson.word.answer.rev');
