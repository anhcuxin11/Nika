<?php

namespace App\Repositories\Company;

use App\Constants\Paginate;
use App\Models\Candidate;
use Illuminate\Support\Arr;

class CandidateRepository
{
    /**
     * Get by id
     */
    public function getById(int $id, array $relation = [])
    {
        return Candidate::query()
                    ->with($relation)
                    ->where('id', $id)
                    ->first();
    }

    public function result(array $data)
    {
        $query = Candidate::query()
                ->with(
                    'resume',
                    'resume.occupations',
                    'resume.industries',
                )
                ->where('status', Candidate::$status['active'])
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
                })
                ->orderByDesc('id');
        $this->filterOcupation($query, $data);
        $this->filterIndustry($query, $data);

        if (!empty($data['key_basic'])) {
            $this->filterKeyBasic($query, $data['key_basic']);
        }
        if (!empty($data['key_exp'])) {
            $this->filterKeyExperience($query, $data['key_exp']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                ->withQueryString();
    }

    public function filterOcupation(&$query, $data)
    {
        $query->whereHas('resume', function ($q) use ($data) {
            $q->when(!empty($data['occupation']), function ($q) use ($data) {
                $occupationIds = Arr::flatten($data['occupation']);
                $q->whereHas('occupations', function ($q) use ($occupationIds) {
                    $q->whereIn('occupations.id', $occupationIds);
                });
            });
        });
    }

    public function filterIndustry(&$query, $data)
    {
        $query->whereHas('resume', function ($q) use ($data) {
            $q->when(!empty($data['industry']), function ($q) use ($data) {
                $industryIds = Arr::flatten($data['industry']);
                $q->whereHas('industries', function ($q) use ($industryIds) {
                    $q->whereIn('industries.id', $industryIds);
                });
            });
        });
    }

    public function filterKeyBasic(&$query, string $key)
    {
        $query->where('id', 'like', "%$key%")
            ->orWhere('lastname', 'like', "%$key%")
            ->orWhere('firstname', 'like', "%$key%")
            ->orWhereHas('resume', function ($q) use ($key) {
                $q->where('address', 'like', "%$key%");
        });
    }

    public function filterKeyExperience(&$query, string $key)
    {
        $query->whereHas('resume', function ($q) use ($key) {
            $q->where('certificate', 'like', "%$key%")
                ->orwhere('skill', 'like', "%$key%")
                ->orWhere('memo', 'like', "%$key%");
        });
    }

    public function mark(int $companyId)
    {
        return Candidate::query()
                    ->with(
                        'resume',
                        'resume.occupations',
                        'resume.industries',
                    )
                    ->where('status', Candidate::$status['active'])
                    ->whereHas('markCompanies', function ($q) use ($companyId) {
                        $q->where('companies.id', $companyId);
                    })
                ->orderByDesc('id')
                ->paginate(Paginate::PER_PAGE_10);
    }
}
