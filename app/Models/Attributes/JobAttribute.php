<?php
namespace App\Models\Attributes;

trait JobAttribute
{
    public function getLocationLabelsAttribute()
    {
        return $this->locations->map(function ($item) {
            return $item->name;
        })->join(' ／ ');
    }

    public function getIndustryLabelsAttribute()
    {
        return $this->industries->map(function ($item) {
            return $item->name;
        })->join(' ／ ');
    }

    public function getOccupationLabelsAttribute()
    {
        return $this->occupations->map(function ($item) {
            return $item->name;
        })->join(' ／ ');
    }
}
