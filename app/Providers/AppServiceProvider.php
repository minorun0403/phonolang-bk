<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterfaces\WordMeaningRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WordQuestionRepositoryInterface;
use App\Repositories\RepositoryInterfaces\WordChoiceRepositoryInterface;
use App\Repositories\WordMeaningRepository;
use App\Repositories\WordQuestionRepository;
use App\Repositories\WordChoiceRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(WordQuestionRepositoryInterface::class, WordQuestionRepository::class);
        $this->app->bind(WordChoiceRepositoryInterface::class, WordChoiceRepository::class);
        $this->app->bind(WordMeaningRepositoryInterface::class, WordMeaningRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (env('APP_DEBUG', false)) {
            DB::listen(function ($query) {
                $sql = vsprintf(str_replace("?", "%s", $query->sql), $query->bindings);
                Log::channel('sql')->debug(
                    "Query Time: {$query->time} ms\n" . $sql
                );
            });
        }
    }
}
