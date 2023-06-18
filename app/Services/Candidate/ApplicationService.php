<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\ApplicationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationService
{
    /**
     * @var ApplicationRepository
     */
    protected $applicationRepository;

    /**
     * OccupationService constructor.
     *
     * @param ApplicationRepository $applicationRepository
     */
    public function __construct(
        ApplicationRepository $applicationRepository
    ) {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * Get all industry
     *
     * @return Collection
     */
    public function apply(int $jobId, Request $request)
    {
        $candidate = auth('web')->user();

        DB::beginTransaction();
        try {
            $application = $this->applicationRepository->create([
                'candidate_id' => $candidate->id,
                'job_id' => $jobId,
            ]);

            DB::commit();
            //send mail
            return true;
        } catch (\Exception $e) {
            Log::error("ERROR_APPLY_JOB: " . $e->getMessage());
            DB::rollBack();

            return false;
        }
    }

    public function getByJobId(int $jobId, int $candidateId)
    {
        return $this->applicationRepository->getByJobId($jobId, $candidateId);
    }
}
