<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'job_no',
        'job_title',
        'job_detail',
        'job_status',
        'location_detail',
        'english_level',
        'experienced_count',
        'education',
        'age_min',
        'age_max',
        'must_condition',
        'position_name',
        'salary_type',
        'salary_min',
        'salary_max',
        'salary_detail',
        'deleted_at',
    ];

    public static $jobStatus = [
        'not_posted'         => 0,
        'now_posted'         => 1,
        'admin_stop'         => 2,
        'pause'              => 3,
        'end_of_publication' => 4,
    ];
}
