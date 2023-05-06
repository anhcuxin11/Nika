<?php

namespace App\Providers;

use App\Services\Candidate\JobService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('candidate.shared.nav-bar', function ($view) {
            $jobCounts = resolve(JobService::class)->getCountJob();

            $view->with([
                'job_counts'  => $jobCounts ?? 0
            ]);
        });
    }
}
