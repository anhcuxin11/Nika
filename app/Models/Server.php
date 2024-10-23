<?php

namespace App\Models;

use App\Models\Relationships\ApplicationRelationship;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use ApplicationRelationship;

    protected $table = 'servers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'count'
    ];

    const SERVER_1 = 'Server 1';
    const SERVER_2 = 'Server 2';
}
