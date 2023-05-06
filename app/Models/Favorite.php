<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    protected $table = 'favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id',
        'job_id',
        'status',
        'deleted_at'
    ];

    public static $status = [
        'not_compatible' => 0,
        'pending' => 1,
        'want_meet' => 2,
        'dont_wanna_meet' => 3
    ];
}
