<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\CompanyRepository;
use App\Repositories\Candidate\FavoriteRepository;
use App\Repositories\Candidate\FeatureRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\LocationRepository;
use Illuminate\Support\Facades\Auth;

class HomeService
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * @var LocationRepository
     */
    protected $locationRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var FeatureRepository
     */
    protected $featureRepository;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * HomeService constructor.
     *
     * @param JobRepository $jobRepository
     * @param LocationRepository $locationRepository
     * @param LanguageRepository $languageRepository
     * @param FeatureRepository $featureRepository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        JobRepository $jobRepository,
        LocationRepository $locationRepository,
        LanguageRepository $languageRepository,
        FeatureRepository $featureRepository,
        CompanyRepository $companyRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->locationRepository = $locationRepository;
        $this->languageRepository = $languageRepository;
        $this->featureRepository = $featureRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Get data in home page
     *
     * @return array
     */
    public function getDataHomePage()
    {
        $locations = $this->locationRepository->getFamousLocation();
        $languages = $this->languageRepository->getPopularLanguage();
        $features = $this->featureRepository->getAll();
        $jobs = $this->jobRepository->getNew();
        $companies = $this->companyRepository->getLimit();
        $jobNews = $this->jobRepository->getNew(10);

        if (Auth::check('web')) {
            $candidate = resolve(CandidateRepository::class)->getById(auth('web')->user()->id, ['resume' , 'resume.resumeRequirementBasic', 'resume.requirementIndustries', 'resume.requirementOccupations']);
            $favoriteCount = resolve(FavoriteRepository::class)->getListfavortieJob(auth('web')->user()->id)->total();
            $jobBySalaryCount = resolve(JobRepository::class)->filter(['salary_requirement' => optional($candidate->resume->resumeRequirementBasic)->requirement_salary ?? 0])->total();
            $resumeOccupationIds = $candidate->resume->requirementOccupations ? optional($candidate->resume->requirementOccupations)->pluck('id')->toArray() : [];
            $resumeIndustryIds = $candidate->resume->requirementIndustries ? optional($candidate->resume->requirementIndustries)->pluck('id')->toArray() : [];
            $jobByExpeeienceCount = resolve(JobRepository::class)->filter([
                'industry' => $resumeIndustryIds,
                'occupation' => $resumeOccupationIds,
            ])->total();

            $resultOccupation = [];
            $resultIndustry = [];
            if ($candidate->resume->requirementOccupations) {
                $resultOccupation = $this->cusTomResults($candidate->resume->requirementOccupations);
            }
            if ($candidate->resume->requirementIndustries) {
                $resultIndustry = $this->cusTomResults($candidate->resume->requirementIndustries);
            }
        }

        return [
            'locations' => $locations,
            'languages' => $languages,
            'features' => $features,
            'jobs' => $jobs,
            'companies' => $companies,
            'jobNews' => $jobNews,
            'candidate' => !empty($candidate) ? $candidate : null,
            'favoriteCount' => !empty($favoriteCount) ? $favoriteCount : 0,
            'jobBySalaryCount' => !empty($jobBySalaryCount) ? $jobBySalaryCount : 0,
            'jobByExpeeienceCount' => !empty($jobByExpeeienceCount) ? $jobByExpeeienceCount : 0,
            'resultOccupation' => !empty($resultOccupation) ? $resultOccupation : [],
            'resultIndustry' => !empty($resultIndustry) ? $resultIndustry : [],
        ];
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
