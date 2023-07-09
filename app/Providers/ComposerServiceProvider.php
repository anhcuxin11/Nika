<?php

namespace App\Providers;

use App\Repositories\Candidate\FeatureRepository;
use App\Services\Candidate\FavoriteService;
use App\Services\Candidate\IndustryService;
use App\Services\Candidate\JobService;
use App\Services\Candidate\LanguageService;
use App\Services\Candidate\LocationService;
use App\Services\Candidate\OccupationService;
use App\Services\Company\JobService as CompanyJobService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('candidate.shared.nav-bar', function ($view) {
            $jobCounts = resolve(JobService::class)->getCountJob();
            $candidate = auth('web')->user();
            $favoriteNum = 0;
            if ($candidate) {
                $favoriteNum = resolve(FavoriteService::class)->getCoutJobByLike($candidate->id)->count();
            }

            $view->with([
                'job_counts'  => $jobCounts ?? 0,
                'favoriteNum'  => $favoriteNum ?? 0,
            ]);
        });

        View::composer('candidate.home.index', function ($view) {
            $occupationColection = resolve(OccupationService::class)->getListChildren();
            $locationColection = resolve(LocationService::class)->getListLocation();
            $languageColection = resolve(LanguageService::class)->getAllLanguage();
            $jobCounts = resolve(JobService::class)->getCountJob();

            $view->with('occupationColection', $occupationColection);
            $view->with('locationColection', $locationColection);
            $view->with('languageColection', $languageColection);
            $view->with('job_counts', $jobCounts ?? 0);
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

        View::composer('company.home.index', function ($view) {
            $jobCounts = resolve(CompanyJobService::class)->getCountJob(auth('company')->id());
            $jobActiveCounts = resolve(CompanyJobService::class)->getCountJobActive(auth('company')->id());
            $jobAllCounts = resolve(JobService::class)->getCountJob();

            $view->with([
                'job_counts'  => $jobCounts ?? 0,
                'job_active_counts'  => $jobActiveCounts ?? 0,
                'job_all_counts'  => $jobAllCounts ?? 0
            ]);
        });

        View::composer('company.jobs.create', function ($view) {
            $occupations = resolve(OccupationService::class)->getListAndChildren();
            $industries = resolve(IndustryService::class)->getListAndChildren();
            $locations = resolve(LocationService::class)->getListLocation();
            $features = resolve(FeatureRepository::class)->getAll();

            $view->with('occupations', $occupations);
            $view->with('industries', $industries);
            $view->with('locations', $locations);
            $view->with('features', $features);
        });

        View::composer('company.jobs.edit', function ($view) {
            $occupations = resolve(OccupationService::class)->getListAndChildren();
            $industries = resolve(IndustryService::class)->getListAndChildren();
            $locations = resolve(LocationService::class)->getListLocation();
            $features = resolve(FeatureRepository::class)->getAll();

            $view->with('occupations', $occupations);
            $view->with('industries', $industries);
            $view->with('locations', $locations);
            $view->with('features', $features);
        });

        View::composer('company.scouts.index', function ($view) {
            $occupations = resolve(OccupationService::class)->getListAndChildren();
            $industries = resolve(IndustryService::class)->getListAndChildren();

            $view->with('occupations', $occupations);
            $view->with('industries', $industries);
        });
    }
}
