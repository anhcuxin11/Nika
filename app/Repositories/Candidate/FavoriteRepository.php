<?php

namespace App\Repositories\Candidate;

use App\Constants\Paginate;
use App\Models\Candidate;
use App\Models\Favorite;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FavoriteRepository
{
    /**
     * Get list of favorite jobs
     *
     * @param int $candidateId
     *
     * @return LengthAwarePaginator
     */
    public function getListfavortieJob(int $candidateId)
    {
        return Favorite::query()
                    ->with('job')
                    ->where('candidate_id', $candidateId)
                    ->whereHas('job', function ($q) {
                        $q->where('job_status', Job::$jobStatus['now_posted']);
                    })
                    ->paginate(Paginate::PER_PAGE_5);
    }

    /**
     * Get list of favorite jobs
     *
     * @param int $candidateId
     *
     * @return Collection
     */
    public function getListFavorites(int $candidateId)
    {
        return Favorite::query()
                    ->with('job')
                    ->where('candidate_id', $candidateId)
                    ->whereHas('job', function ($q) {
                        $q->where('job_status', Job::$jobStatus['now_posted']);
                    })
                    ->get();
    }

    /**
     * Store job to favorites
     *
     * @param int $jobId
     * @param int $candidateId
     */
    public function addFavoriteList(int $jobId, int $candidateId)
    {
        Favorite::withTrashed()->updateOrCreate([
            'candidate_id' => $candidateId,
            'job_id' => $jobId
        ], [
            'status' => Favorite::$status['not_compatible'],
            'deleted_at' => null
        ]);
    }

    /**
     * Get favorite by job id
     */
    public function getFavoriteByJobId(int $jobId, int $candidateId)
    {
        return Favorite::query()
            ->where([
                'candidate_id' => $candidateId,
                'job_id' => $jobId
            ])
            ->first();
    }

    /**
     * Delete favorite by id
     */
    public function deleteFavoriteJob(int $id)
    {
        Favorite::find($id)->delete();
    }
}
