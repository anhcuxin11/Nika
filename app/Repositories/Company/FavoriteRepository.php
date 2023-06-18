<?php

namespace App\Repositories\Company;

use App\Constants\Paginate;
use App\Models\Candidate;
use App\Models\Favorite;

class FavoriteRepository
{
    public function getByCompany(int $companyId)
    {
        return Favorite::query()
                    ->with(
                        'job',
                        'job.company',
                        'candidate',
                        'candidate.resume',
                        'candidate.resume.occupations',
                        'candidate.resume.industries',
                    )
                    ->whereHas('job', function($q) use ($companyId) {
                        $q->where('company_id', $companyId);
                    })
                    ->whereHas('candidate', function($q) {
                        $q->where('status', Candidate::$status['active'])
                            ->has('resume');
                    })
                    ->orderByDesc('id')
                    ->paginate(Paginate::PER_PAGE_10);
    }

}
