<?php

namespace App\Repositories\Company;

use App\Constants\Paginate;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class JobRepository
{
    public function getById(int $id)
    {
        return Job::query()->where('id', $id)->first();
    }

    /**
     * Get all jobs
     *
     * @return Collection
     */
    public function getCountJob($companyId): Collection
    {
        return Job::query()
                    ->where('company_id', $companyId)
                    ->withTrashed()
                    ->get();
    }

    /**
     * Get all jobs
     *
     * @return Collection
     */
    public function getCountJobActive($companyId): Collection
    {
        return Job::query()
                    ->where('company_id', $companyId)
                    ->where('job_status', Job::$jobStatus['now_posted'])
                    ->get();
    }

    /**
     * Get all jobs
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Job::query()
                ->with('locations', 'occupations', 'industries', 'languages', 'features')
                ->where('job_status', Job::$jobStatus['now_posted'])
                ->orderByDesc('id')
                ->paginate(Paginate::PER_PAGE_10);
    }

    /**
     * @param array $status
     * @param int $companyId
     */
    public function countJobStatus(array $status, int $companyId)
    {
        return Job::query()
            ->where('company_id', $companyId)
            ->whereIn('job_status', $status)
            ->get();
    }

    public function updateStatusJob(int $id, int $status)
    {
        return Job::query()->where('job_status', '!=', 2)->find($id);

    }

    public function getAllWithCompany(array $data, int $companyId, int $tag)
    {
        $query = Job::query()
                    ->where('company_id', $companyId)
                    ->orderByDesc('id')
                    ->when(!empty($data['keyword']), function ($q) use ($data) {
                        $q->where(function ($q) use ($data) {
                            $q->where('id', 'like', '%' . $data['keyword'] . '%');
                            $q->orWhere('job_title', 'like', '%' . $data['keyword'] . '%');
                            $q->orWhere('job_detail', 'like', '%' . $data['keyword'] . '%');
                            $q->orWhereHas('company', function ($q) use ($data) {
                                $q->where('name', 'like', '%' . $data['keyword'] . '%');
                            });
                        });

                    })
                    ->when(!empty($data['status']), function ($q) use ($data) {
                        $q->where('job_status', $data['status']);
                    });

        if ($tag == 1) {
            $query->where('job_status', 0);
        } else if ($tag == 2) {
            $query->whereIn('job_status', [1, 2, 3]);
        } else {
            $query->where('job_status', 4);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    /**
     * Get job by id
     */
    public function getJobById(int $id)
    {
        return Job::query()
            ->with('company', 'locations', 'occupations', 'industries', 'languages', 'features')
            ->findOrFail($id);
    }

    /**
     * Save job
     *
     * @return Job|mixed
     */
    public function store(array $data)
    {
        return Job::create($data);
    }
}
