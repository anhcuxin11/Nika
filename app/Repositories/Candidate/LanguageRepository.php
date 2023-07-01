<?php

namespace App\Repositories\Candidate;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository
{
    /**
     * Get popular location
     *
     * @return Collection
     */
    public function getPopularLanguage(): Collection
    {
        return Language::query()
                    ->limit(4)
                    ->get();
    }

    /**
     * Get popular location
     *
     * @return Collection
     */
    public function getAllLanguage(): Collection
    {
        return Language::query()
                    ->get();
    }
}
