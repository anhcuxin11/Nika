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
                    ->where('job_publish', Job::$jobPublishs['on'])
                    ->get();
    }

    /**
     * Get 2 new jobs
     *
     * @return Collection
     */
    public function getNew($limit = 2)
    {
        return Job::query()
                    ->orderByDesc('id')
                    ->limit($limit)
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
                ->where('job_publish', Job::$jobPublishs['on'])
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
                    ->with(['languages', 'locations', 'occupations', 'industries'])
                    ->where('job_status', Job::$jobStatus['now_posted'])
                    ->where('job_publish', Job::$jobPublishs['on'])
                    ->when(!empty($data['location']), function ($q) use ($data) {
                        $q->whereHas('locations', function ($q) use ($data) {
                            $q->where('locations.id', $data['location']);
                        });
                    })
                    ->when(!empty($data['new']), function ($q) {
                        $q->orderByDesc('updated_at');
                    });
        // if (isset($data['salary_type'])) {
        //     $this->filterSalary($query, $data);
        // }
        $this->filterRequirementSalary($query, $data);
        $this->filterOcupation($query, $data);
        $this->filterIndustry($query, $data);
        $this->filterSalary($query, $data);
        $this->filterFeature($query, $data);
        $this->filterAge($query, $data);
        $this->filterLevel($query, $data);
        $this->filterCompany($query, $data);
        if (!empty($data['key'])) {
            $this->filterKey($query, $data['key']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    /**
     * Count jobs by conditions
     */
    public function countJob(array $data)
    {
        // dd($data);
        $query = Job::query()
                    ->where('job_status', Job::$jobStatus['now_posted'])
                    ->where('job_publish', Job::$jobPublishs['on'])
                    ->when(!empty($data['location']), function ($q) use ($data) {
                        $q->whereHas('locations', function ($q) use ($data) {
                            $q->where('locations.id', $data['location']);
                        });
                    });

        $this->filterOcupation($query, $data);
        $this->filterLevel($query, $data);
        if (!empty($data['key'])) {
            $this->filterKey($query, $data['key']);
        }

        return $query;
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
        $query->when(!empty($data['salary_min']), function ($q) use ($data) {
            $q->where(function ($q) use ($data) {
                $q->where('salary_min', '>=', $data['salary_min'])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('salary_min', '<=', $data['salary_min'])
                            ->where('salary_max', '>=', $data['salary_min']);
                    });
            });
        });
        $query->when(!empty($data['salary_max']), function ($q) use ($data) {
            $q->where(function ($q) use ($data) {
                $q->where('salary_max', '<=', $data['salary_max'])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('salary_min', '<=', $data['salary_max'])
                            ->where('salary_max', '>=', $data['salary_max']);
                    });
            });
        });
    }

    public function filterRequirementSalary(&$query, $data)
    {
        $query->when(!empty($data['salary_requirement']), function ($q) use ($data) {
                $q->where('salary_min', '<=', $data['salary_requirement'])
                    ->where('salary_max', '>=', $data['salary_requirement']);
            });
    }

    public function filterCompany(&$query, $data)
    {
        $query->when(!empty($data['company_id']), function ($q) use ($data) {
            $q->where('company_id', $data['company_id']);
        });
    }

    public function filterAge(&$query, $data)
    {
        $query->when(!empty($data['age_min']), function ($q) use ($data) {
            $q->where(function ($q) use ($data) {
                $q->where('age_min', '>=', $data['age_min'])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('age_min', '<=', $data['age_min'])
                            ->where('age_max', '>=', $data['age_min']);
                    });
            });
        });
        $query->when(!empty($data['age_max']), function ($q) use ($data) {
            $q->where(function ($q) use ($data) {
                $q->where('age_max', '<=', $data['age_max'])
                    ->orWhere(function ($q) use ($data) {
                        $q->where('age_min', '<=', $data['age_max'])
                            ->where('age_max', '>=', $data['age_max']);
                    });
            });
        });
    }

    public function filterLevel(&$query, $data)
    {
        $query->when(!empty($data['language']), function ($q) use ($data) {
            $q->whereHas('languages', function ($q) use ($data) {
                $q->where('job_languages.language_id', $data['language'])
                    ->when(!empty($data['language_levels']), function ($q) use ($data) {
                        $q->whereIn('job_languages.level', $data['language_levels']);
                    });
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

    /**
     * Get job by id
     */
    public function getById(int $id)
    {
        return Job::query()
            ->with('company')
            ->findOrFail($id);
    }

    /**
     * @param int $candidateId
     */
    public function getByMessage(int $candidateId)
    {
        return Job::query()
                ->with(['messages' => function ($q) use ($candidateId) {
                    $q->where('candidate_id', $candidateId);
                }],
                'company'
                )
                ->whereHas('messages', function ($q) use ($candidateId) {
                    $q->where('candidate_id', $candidateId);
                })
                ->get();
    }
}
