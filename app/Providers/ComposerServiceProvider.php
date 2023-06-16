<?php

namespace App\Providers;

use App\Services\Candidate\IndustryService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\LocationService;
use App\Services\Candidate\OccupationService;
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

        View::composer('candidate.desired.index', function ($view) {
            $occupations = resolve(OccupationService::class)->getListAndChildren();
            $industries = resolve(IndustryService::class)->getListAndChildren();
            $locations = resolve(LocationService::class)->getListLocation();

            $view->with('occupations', $occupations);
            $view->with('industries', $industries);
            $view->with('locations', $locations);
        });

        View::composer('candidate.resume.edit-job', function ($view) {
            $occupations = resolve(OccupationService::class)->getListAndChildren();
            $industries = resolve(IndustryService::class)->getListAndChildren();

            $view->with('occupations', $occupations);
            $view->with('industries', $industries);
        });
    }
}
