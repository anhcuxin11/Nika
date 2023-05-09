<?php

namespace App\Models\Relationships;

use App\Models\Industry;

trait IndustryRelationship
{
    public function childrens()
    {
        return $this->hasMany(Industry::class, 'parent_id', 'id');
    }
}
