<?php

namespace App\Services\Company;

use App\Repositories\Company\CandidateRepository;

class CandidateService
{
    /**
     * @var CandidateRepository
     */
    protected $candidateRepository;

    /**
     * CandidateService constructor.
     *
     * @param CandidateRepository $candidateRepository
     */
    public function __construct(
        CandidateRepository $candidateRepository
    ) {
        $this->candidateRepository = $candidateRepository;
    }

    public function result(array $data)
    {
        return $this->candidateRepository->result($data);
    }

    public function mark()
    {
        return $this->candidateRepository->mark(auth('company')->user()->id);
    }
}
