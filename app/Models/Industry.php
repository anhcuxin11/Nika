<?php

namespace App\Models;

use App\Models\Relationships\IndustryRelationship;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use IndustryRelationship;

    protected $table = 'industries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public static $name = [
        'Manufacturer' => null,//1
        'IT · Communication · Internet' => null,
        'Advertising, mass media design related' => null,
        'Service' => null,
        'Retail / distribution' => null,
        'Medical and welfare' => null,
        'Consulting' => null,
        'Environment and energy' => null,//8
        'Home appliances and AV equipment' => 1,//1
        'Game, toy, entertainment' => 1,
        'Computer communication system' => 1,
        'Automatic, airplane, transportation' => 1,
        'Medical equipment' => 1,
        'Medicine, supplement, cosmetics' => 1,
        'Software · Web · App' => 2,//2
        'Web Services Media Promotion' => 2,
        'Game related' => 2,
        'Communication carrier, communication related' => 2,
        'Broadcasting, video, sound' => 3,//3
        'Newspapers, advertising, publishing, printing' => 3,
        'Design Art Events, Other' => 3,
        'Food and drink · others' => 4,//4
        'Hotel, Ryokan, Corner Funeral' => 4,
        'Travel and leisure amusement' => 4,
        'Beauty, Barber, Este, Health, Fitness' => 4,
        'Education and childcare' => 4,
        'Building Management, Maintenance, Security' => 4,
        'Department stores, GMS' => 5,//5
        'Super Convenience Stores, Grocery' => 5,
        'Drugstore and dispensing pharmacy' => 5,
        'Home appliances and mass retailers' => 5,
        'Fashion apparel sports' => 5,
        'Medical care' => 6,//6
        'Care, welfare, other' => 6,
        'Think tank marketing and survey' => 7,//7
        'Specialized consultant' => 7,
        'Verical work, personal office, other' => 7,
        'Environment and recycling' => 8,//8
        'Power, gas, energy, others' => 8
    ];
}
