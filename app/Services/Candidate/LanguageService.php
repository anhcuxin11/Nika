<?php

namespace App\Services\Candidate;

use App\Repositories\Candidate\LanguageRepository;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * Language Service constructor.
     *
     * @param LanguageRepository $languageRepository
     */
    public function __construct(
        LanguageRepository $languageRepository
    ) {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Get all industry
     *
     * @return Collection
     */
    public function getAllLanguage()
    {
        return $this->languageRepository->getAllLanguage();
    }
}
