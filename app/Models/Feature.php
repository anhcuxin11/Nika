<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static $name = [
        'English Language Skills',
        'Company Language is English',
        'Working remotely',
        'Foreign company',
        'Domestic company',
        'Fresh out of school',
        'No experience',
        'Location manager',
        'Join now',
        'Saturday, Sunday',
        'Short term',
        'Almost no overtime',
    ];

}
