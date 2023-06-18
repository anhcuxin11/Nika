<?php

namespace App\Services\Company;

use App\Repositories\Company\ApplicationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationService
{
    /**
     * @var ApplicationRepository
     */
    protected $applicationRepository;

    /**
     * ApplicationService constructor.
     *
     * @param ApplicationRepository $applicationRepository
     */
    public function __construct(
        ApplicationRepository $applicationRepository
    ) {
        $this->applicationRepository = $applicationRepository;
    }

    public function getByCompany()
    {
        return $this->applicationRepository->getByCompany(auth('company')->user()->id);
    }
}
