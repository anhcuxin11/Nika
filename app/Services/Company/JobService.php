<?php

namespace App\Services\Company;

use App\Http\Requests\Company\CreateJobRequest;
use App\Http\Requests\Company\UpdateJobRequest;
use App\Models\Job;
use App\Repositories\Company\JobRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * JobService constructor.
     *
     * @param JobRepository $jobRepository
     */
    public function __construct(
        JobRepository $jobRepository
    ) {
        $this->jobRepository = $jobRepository;
    }

    public function getById(int $id)
    {
        return $this->jobRepository->getById($id);
    }

    /**
     * Get total jobs posted
     *
     * @return int
     */
    public function getCountJob(int $companyId)
    {
        return $this->jobRepository->getCountJob($companyId)->count();
    }

    /**
     * Get total jobs posted active
     *
     * @return int
     */
    public function getCountJobActive(int $companyId)
    {
        return $this->jobRepository->getCountJobActive($companyId)->count();
    }

    /**
     * Get all jobs
     *
     * @return LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->jobRepository->getAll();
    }

    public function updateStatusJob(array $ids, $status)
    {
        foreach ($ids as $id) {
            $job = $this->jobRepository->updateStatusJob($id, $status);
            if ($job) {
                $job->update([
                    'job_status' => $status,
                ]);
            }
        }
    }

    /**
     * @param array $status
     */
    public function countJobStatus(array $status)
    {
        return $this->jobRepository->countJobStatus($status, auth('company')->user()->id);
    }

    /**
     * Get job by id
     */
    public function getJobById(int $id)
    {
        return $this->jobRepository->getJobById($id);
    }

    public function getAllWithCompany(array $data, int $companyId, int $tag)
    {
        return $this->jobRepository->getAllWithCompany($data, $companyId, $tag);
    }

    public function create(CreateJobRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = resolve(Job::class)->fillable;
            $data = $request->only($fields);
            $data['company_id'] = auth('company')->user()->id;
            $job = $this->jobRepository->store($data);
            $this->saveRelations($job, $request);

            DB::commit();
            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_CREATE_JOB: " . $e->getMessage());
            return false;
        }
    }

    public function update(Job $job, UpdateJobRequest $request)
    {
        try {
            DB::beginTransaction();

            $fields = resolve(Job::class)->fillable;
            $data = $request->only($fields);
            $data['company_id'] = auth('company')->user()->id;

            $job->update($data);
            $this->saveRelations($job, $request);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_JOB: " . $e->getMessage());
            return false;
        }//end try
    }

    public function saveRelations(Job $job, Request $request)
    {
        $industryIds = $request->get('industry') ? Arr::flatten($request->get('industry')) : [];
        $occupationIds = $request->get('occupation') ? Arr::flatten($request->get('occupation')) : [];
        $locationIds = $request->get('location') ? [$request->get('location')] : [];
        $featureIds = $request->get('feature') ? [$request->get('feature')] : [];
        $languageLevel = $request->get('language_level');
        $languageId = $request->get('language');

        $job->locations()->sync($locationIds);
        $job->industries()->sync($industryIds);
        $job->occupations()->sync($occupationIds);
        $job->features()->sync($featureIds);
        $job->languages()->sync([$languageId => ['level' => $languageLevel]]);
    }
}
