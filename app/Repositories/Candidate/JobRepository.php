<?php

namespace App\Repositories\Candidate;

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class JobRepository
{
    /**
     * Get all jobs
     *
     * @return Collection
     */
    public function getCountJob(): Collection
    {
        return Job::query()
                    ->where('job_status', Job::$jobStatus['now_posted'])
                    ->get();
    }

    /**
     * Get 2 new jobs
     *
     * @return Collection
     */
    public function getNew()
    {
        return Job::query()
                    ->orderByDesc('id')
                    ->limit(2)
                    ->get();

    }
}
