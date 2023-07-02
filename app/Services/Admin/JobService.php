<?php

namespace App\Services\Admin;

use App\Constants\Paginate;
use App\Models\Company;
use App\Models\Job;
use Exception;
use Illuminate\Support\Facades\Log;

class JobService
{
    public function filter(array $data)
    {
        $query = Job::query()
                    ->with(['company' => function ($q) {
                        $q->withTrashed();
                    }])
                    ->when(isset($data['name']), function ($q) use ($data) {
                        $q->whereHas('company', function ($q) use ($data) {
                            $q->where('name', 'like', '%' . $data['name'] . '%');
                        });
                    })
                    ->when(isset($data['job_status']), function ($q) use ($data) {
                        $q->where('job_status', $data['job_status']);
                    })
                    ->orderByDesc('id')
                    ->withTrashed();
        $this->filterAge($query, $data);
        $this->filterSalary($query, $data);

        if (!empty($data['key'])) {
            $this->filterKey($query, $data['key']);
        }

        return $query->paginate(Paginate::PER_PAGE_10)
                    ->withQueryString();
    }

    public function filterAge(&$query, $data)
    {
        $query->where(function ($q) use ($data) {
                $q->when(!empty($data['age_min']), function ($q) use ($data) {
                        $q->where('age_min', '<=', $data['age_min'])
                            ->where('age_max', '>=', $data['age_min']);
                    });
                })
            ->orWhere(function ($q) use ($data) {
                $q->when(!empty($data['age_max']), function ($q) use ($data) {
                    $q->where('age_min', '<=', $data['age_max'])
                        ->where('age_max', '>=', $data['age_max']);
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

    public function filterKey(&$query, string $key)
    {
        $query->where(function ($q) use ($key) {
            $q->where('id', 'like', "%$key%")
                ->orWhere('job_title', 'like', "%$key%")
                ->orWhere('job_detail', 'like', "%$key%");
        });
    }

    public function updateStatus(int $id, array $data)
    {
        try {
            $job = Job::query()->where('id', $id)->first();
            if ($job && isset($data['job_publish'])) {
                if ($data['job_publish'] == 1) {
                    $job->update([
                        'job_publish' => $data['job_publish'],
                        'job_status' => 2,
                    ]);
                } else {
                    $job->update([
                        'job_publish' => $data['job_publish'],
                        'job_status' => 1,
                    ]);
                }
            }

            return true;
        } catch(Exception $e) {
            Log::error("UPDATE_STATUS: " . $e->getMessage());

            return false;
        }
    }
}
