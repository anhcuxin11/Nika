<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\CreateJobRequest;
use App\Http\Requests\Company\UpdateJobRequest;
use App\Http\Requests\Company\UpdateJobStatusRequest;
use App\Models\Job;
use App\Services\Company\JobService;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JobController
{
    use Helpers;
     /**
     * @var JobService
     */
    protected $jobService;

    /**
     * @param JobService $jobService
     */
    public function __construct(
        JobService $jobService
    )
    {
        $this->jobService = $jobService;
    }
    /**
     * Get data in home page
     */
    public function index(Request $request)
    {
        $activeTab = $request->query('tab') ?? 2;
        $validTabs = [1, 2, 3];
        if (!in_array($activeTab, $validTabs)) {
            return redirect()->route('company.jobs', ['tab' => 2]);
        }
        $toolbarStatuses = [
            1 => 'Now posted',
            2 => 'Admin stop',
            3 => 'Pause',
        ];

        $countTab1 = $this->jobService->countJobStatus([Job::$jobStatus['not_posted']])->count();
        $countTab2 = $this->jobService->countJobStatus([Job::$jobStatus['now_posted'], Job::$jobStatus['pause']])->count()
                        + $this->jobService->countSuspendedJob()->count();
        $countTab3 = $this->jobService->countJobStatus([Job::$jobStatus['end_of_publication']])->count();

        $jobs = $this->jobService->getAllWithCompany($request->all(), auth('company')->user()->id, $activeTab);


        return view('company.jobs.index', compact(
            'activeTab',
            'countTab1',
            'countTab2',
            'countTab3',
            'jobs',
            'toolbarStatuses',
        ));
    }

    public function create()
    {
        return view('company.jobs.create');
    }

    public function store(CreateJobRequest $request)
    {
        $job = $this->jobService->create($request);
        if ($job) {
            return redirect()->route('company.jobs')
                ->with('msg_success', 'Save job successfull');
        } else {
            return redirect()->back()->withInput()
                ->with('msg_error', 'Save job failed' );
        }
    }

    public function edit(int $id)
    {
        $job = $this->jobService->getJobById($id);

        $resultOccupation = [];
        $resultIndustry = [];
        if ($job->occupations) {
            $resultOccupation = $this->cusTomResults($job->occupations);
        }
        if ($job->industries) {
            $resultIndustry = $this->cusTomResults($job->industries);
        }

        return view('company.jobs.edit', compact('job', 'resultOccupation', 'resultIndustry'));
    }

    public function update($id, UpdateJobRequest $request)
    {
        $job = $this->jobService->getById($id);
        $update = $this->jobService->update($job, $request);

        if (!$job || !$update) {
            return redirect()->back()->withInput()
                ->with('msg_error', 'Save job failed');
        }

        return redirect()->route('company.jobs')
                ->with('msg_success', 'Save job successfull');
    }

    public function updateMultiStatus(UpdateJobStatusRequest $request)
    {
        try {
            DB::beginTransaction();
            $jobIds = $request->get('job_ids');
            $status = $request->get('status');
            // $statuses = $this->getConditionStatuses($status);
            $this->jobService->updateStatusJob($jobIds, $status);

            DB::commit();
            return $this->response
                    ->array(['message' => 'Save job success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_MULTI_JOB_STATUS: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            DB::beginTransaction();
            $this->jobService->updateStatusJob([$id], $status);

            DB::commit();
            return $this->response
                    ->array(['message' => trans('Save job success')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR_UPDATE_JOB_STATUS: ". $e->getMessage());
            return $this->response->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Custom
     */
    public function cusTomResults($collection)
    {
        $a = [];
        $CollectionIds = $collection->pluck('parent_id', 'id')->toArray();
        $parentIds = $collection->pluck('id', 'parent_id')->toArray();
        foreach ($parentIds as $key => $value) {
            $b = [];
            foreach ($CollectionIds as $k => $v) {
                if ($key == $v) {
                    $b += [
                        $k => [
                            'id' => $k
                        ]
                    ];
                }
            }
            $a += [$key => $b];
        }

        return $a;
    }
}
