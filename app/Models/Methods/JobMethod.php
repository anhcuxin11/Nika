<?php

namespace App\Models\Methods;

use App\Models\Favorite;

trait JobMethod
{
    public function isFavorite(int $userId)
    {
        $jobId = $this->id;
        $favorite = Favorite::query()
            ->where([
                'candidate_id' => $userId,
                'job_id' => $jobId
            ])
            ->get();

        return count($favorite);
    }
}
