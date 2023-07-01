<?php

namespace App\Services\Admin;

use App\Constants\Paginate;
use App\Http\Requests\Admin\UpdateCandidateRequest;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Job;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OverviewService
{
    /**
     * Get data top page
     *
     * @return array
     */
    public function overview()
    {
        $totalCandidates = Candidate::query()->withTrashed()->count();
        $totalActiveCandidates = Candidate::query()->where('status', Candidate::$status['active'])->withTrashed()->count();
        $totalCompanies = Company::query()->withTrashed()->count();
        $totalActiveCompanies = Company::query()->where('status', Company::$status['active'])->withTrashed()->count();
        $totalJobs = Job::query()->withTrashed()->count();
        $jobCategories = $this->jobCotegories();

        return [
            'totalCandidates' => $totalCandidates,
            'totalCompanies' => $totalCompanies,
            'totalJobs' => $totalJobs,
            'totalActiveCandidates' => $totalActiveCandidates,
            'totalActiveCompanies' => $totalActiveCompanies,
            'jobCategories' => $jobCategories,
        ];
    }

    /**
     * Get total job by cotegories
     *
     * @return array
     */
    public function jobCotegories()
    {
        $notPosted = $this->getJobsByStatus(Job::$jobStatus['not_posted'])->count();
        $nowPosted = $this->getJobsByStatus(Job::$jobStatus['now_posted'])->count();
        $suspended = $this->getJobsByStatus(Job::$jobStatus['admin_stop'])->count();
        $pause = $this->getJobsByStatus(Job::$jobStatus['pause'])->count();
        $endOfPublication = $this->getJobsByStatus(Job::$jobStatus['end_of_publication'])->count();

        return [
            0 => $notPosted,
            1 => $nowPosted,
            2 => $suspended,
            3 => $pause,
            4 => $endOfPublication,
        ];
    }

    /**
     * Query jobs by status
     */
    public function getJobsByStatus($status = 2)
    {
        return Job::query()
                ->where('job_status', $status)
                ->withTrashed();
    }
}
