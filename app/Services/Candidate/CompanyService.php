<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\CompanyRepository;
use App\Repositories\Candidate\FeatureRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\LocationRepository;

class CompanyService
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * CompanyService constructor.
     *
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        CompanyRepository $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
    }

    public function getById(int $id)
    {
        return $this->companyRepository->getById($id);
    }

    public function getAllExceptId(int $id)
    {
        return $this->companyRepository->getAllExceptId($id);
    }
}
