<?php

namespace App\Repositories\Candidate;

use App\Constants\Paginate;
use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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
     * Get jobs by conditions
     *
     * @param array $data
     *
     * @return LengthAwarePaginator
     */
    public function filter(array $data)
    {

        $query = Job::query()
                    ->where('job_status', Job::$jobStatus['now_posted'])
                    ->when(isset($data['location']), function ($q) use ($data) {
                        $q->whereHas('locations', function ($q) use ($data) {
                            $q->where('locations.id', $data['location']);
                        });
                    });
        if (isset($data['salary_type'])) {
            $this->filterSalary($query, $data);
        }
        $this->filterOcupation($query, $data);
        $this->filterIndustry($query, $data);
        $this->filterSalary($query, $data);
        $this->filterFeature($query, $data);
        $this->filterAge($query, $data);
        $this->filterLevel($query, $data);
        if (!empty($data['key'])) {
            $this->filterKey($query, $data['key']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    public function filterOcupation(&$query, $data)
    {
        $query->when(!empty($data['occupation']), function ($q) use ($data) {
            $occupationIds = Arr::flatten($data['occupation']);
            $q->whereHas('occupations', function ($q) use ($occupationIds) {
                $q->whereIn('occupations.id', $occupationIds);
            });
        });
    }

    public function filterIndustry(&$query, $data)
    {
        $query->when(!empty($data['industry']), function ($q) use ($data) {
            $industryIds = Arr::flatten($data['industry']);
            $q->whereHas('industries', function ($q) use ($industryIds) {
                $q->whereIn('industries.id', $industryIds);
            });
        });
    }

    public function filterFeature(&$query, $data)
    {
        $query->when(!empty($data['feature_id']), function ($q) use ($data) {
            $q->whereHas('features', function ($q) use ($data) {
                $q->whereIn('features.id', $data['feature_id']);
            });
        });
    }

    public function filterSalary(&$query, $data)
    {
        $query->where('salary_min', '>=', $data['salary_min'] ?? 0)
            ->when(!empty($data['salary_max']), function ($q) use ($data) {
                $q->where('salary_max', '<=', $data['salary_max']);
            });
    }

    public function filterAge(&$query, $data)
    {
        $query->when(!empty($data['age_min']), function ($q) use ($data) {
                $q->where('age_min', '>=', $data['age_min']);
            })
            ->when(!empty($data['age_max']), function ($q) use ($data) {
                $q->where('age_max', '<=', $data['age_max']);
            });
    }

    public function filterLevel(&$query, $data)
    {
        $query->when(!empty($data['language']) && !empty($data['language_levels']), function ($q) use ($data) {
            $q->whereHas('languages', function ($q) use ($data) {
                $q->whereIn('job_languages.level', $data['language_levels']);
            });
        });
    }

    public function filterKey(&$query, string $key)
    {
        $query->where(function ($q) use ($key) {
            $q->where('job_title', 'like', "%$key%")
                ->orWhere('job_detail', 'like', "%$key%")
                ->orWhere('salary_detail', 'like', "%$key%")
                ->orWhere('must_condition', 'like', "%$key%")
                ->orWhere('education', 'like', "%$key%")
                ->orWhere('location_detail', 'like', "%$key%")
                ->orWhere('position_name', 'like', "%$key%");
        });
    }

    /**
     * List recently viewed jobs
     *
     * @param array $jobIds
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function getRecentlyViewedJobs(array $jobIds)
    {
        if (!$jobIds) {
            return [];
        }

        return Job::query()
            ->whereIn('id', $jobIds)
            ->orderByRaw('FIELD (id, ' . implode(', ', $jobIds) . ') ASC')
            ->get();
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
}
