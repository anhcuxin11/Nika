<?php

namespace App\Models\Relationships;

use App\Models\Occupation;

trait OccupationRelationship
{
    public function childrens()
    {
        return $this->hasMany(Occupation::class, 'parent_id', 'id');
    }
}
