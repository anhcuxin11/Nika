<?php

namespace App\Jobs\Company;

use App\Repositories\Candidate\CompanyRepository;
use App\Repositories\Company\CandidateRepository;
use App\Repositories\Company\JobRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $candidateId;

    /**
     * @var int
     */
    private $jobId;

    /**
     * @var int
     */
    private $companyId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $candidateId, int $jobId, int $companyId)
    {
        $this->candidateId = $candidateId;
        $this->jobId = $jobId;
        $this->companyId = $companyId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("=== [START SEND TO CANDIDATE BY ID = {$this->candidateId}] ===");
        $candidate = resolve(CandidateRepository::class)->getById($this->candidateId);
        $company = resolve(CompanyRepository::class)->getById($this->companyId);
        $job = resolve(JobRepository::class)->getById($this->jobId);
        $candidate->sendReplyApplicationNotification($company, $job);
    }
}
