<?php

namespace App\Models;

use App\Models\Relationships\ResumeRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use ResumeRelationship,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sex',
        'country',
        'phone',
        'address',
        'facebook',
        'current_salary',
        'skill',
        'certificate',
        'hobby',
        'memo',
    ];

    public static $sex = [
        'male' => 0,
        'female' => 1,
    ];

    public static $sexLable = [
        0 => 'Male',
        1 => 'Female',
    ];

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
