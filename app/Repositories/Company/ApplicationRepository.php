<?php

namespace App\Repositories\Company;

use App\Constants\Paginate;
use App\Models\Application;
use App\Models\Candidate;

class ApplicationRepository
{
    public function getById(int $id)
    {
        return Application::query()->where('id', $id)->first();
    }

    public function getByCompany(array $data, int $companyId)
    {
        $query = Application::query()
                    ->with(
                        'job',
                        'job.company',
                        'candidate',
                        'candidate.resume',
                        'candidate.resume.occupations',
                        'candidate.resume.industries',
                    )
                    ->when(isset($data['status']), function ($q) use ($data) {
                        $q->where('status', $data['status']);
                    })
                    ->whereHas('job', function($q) use ($companyId) {
                        $q->where('company_id', $companyId);
                    })
                    ->whereHas('candidate', function ($q) use ($data) {
                        $q->where('status', Candidate::$status['active'])
                            ->whereHas('resume', function ($q) use ($data) {
                                $q->when(isset($data['age_min']), function ($q) use ($data) {
                                        $q->where('age', '>=', $data['age_min']);
                                    })
                                    ->when(isset($data['age_max']), function ($q) use ($data) {
                                        $q->where('age', '<=', $data['age_max']);
                                    });
                                $q->when(isset($data['salary_min']) && $data['salary_min'], function ($q) use ($data) {
                                        $q->where('current_salary', '>=', $data['salary_min']);
                                    })
                                    ->when(isset($data['salary_max']) && $data['salary_max'], function ($q) use ($data) {
                                        $q->where('current_salary', '<=', $data['salary_max']);
                                    });
                            });
                    })
                    ->orderByDesc('id');

        if (!empty($data['key_job'])) {
            $this->filterKeyJob($query, $data['key_job']);
        }
        if (!empty($data['key_candidate'])) {
            $this->filterKeyCandidate($query, $data['key_candidate']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    public function filterKeyJob(&$query, string $key)
    {
        $query->whereHas('job', function ($q) use ($key) {
            $q->where('id', 'like', "%$key%")
                ->orWhere('job_title', 'like', "%$key%")
                ->orWhere('job_detail', 'like', "%$key%")
                ->orWhere('education', 'like', "%$key%");
        });
    }

    public function filterKeyCandidate(&$query, string $key)
    {
        $query->whereHas('candidate', function ($q) use ($key) {
            $q->where('id', 'like', "%$key%")
                ->orWhere('firstname', 'like', "%$key%")
                ->orWhere('lastname', 'like', "%$key%")
                ->orWhereHas('resume', function ($q) use ($key) {
                    $q->where('certificate', 'like', "%$key%")
                        ->orwhere('skill', 'like', "%$key%");
                });
        });
    }
}
