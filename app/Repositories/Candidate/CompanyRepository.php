<?php

namespace App\Repositories\Candidate;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository
{
    /**
     * @return Collection
     */
    public function getLimit()
    {
        return Company::query()
            ->limit(4)
            ->get();
    }

    /**
     * @return Company|null
     */
    public function getById(int $id)
    {
        return Company::query()
            ->with('jobs')
            ->where('id', $id)
            ->first();
    }

    /**
     * @return Collection
     */
    public function getAllExceptId(int $id)
    {
        return Company::query()
            ->where('id', '!=',  $id)
            ->get();
    }
}
