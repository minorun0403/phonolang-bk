<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Question\QuestionRepositoryInterface;
use App\Repositories\Question\QuestionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }

    public function boot()
    {
        //
    }
}
