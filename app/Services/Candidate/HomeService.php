<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\FeatureRepository;
use App\Repositories\Candidate\JobRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\LocationRepository;

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
     * HomeService constructor.
     *
     * @param JobRepository $jobRepository
     * @param LocationRepository $locationRepository
     * @param LanguageRepository $languageRepository
     * @param FeatureRepository $featureRepository
     */
    public function __construct(
        JobRepository $jobRepository,
        LocationRepository $locationRepository,
        LanguageRepository $languageRepository,
        FeatureRepository $featureRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->locationRepository = $locationRepository;
        $this->languageRepository = $languageRepository;
        $this->featureRepository = $featureRepository;
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

        return [
            'locations' => $locations,
            'languages' => $languages,
            'features' => $features,
            'jobs' => $jobs,
        ];
    }
}
