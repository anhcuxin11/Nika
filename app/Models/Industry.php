<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
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
        'Manufacturer',//1
        'IT · Communication · Internet',
        'Advertising, mass media design related',
        'Service',
        'Retail / distribution',
        'Medical and welfare',
        'Consulting',
        'Environment and energy',//8
        'Home appliances and AV equipment',//1
        'Game, toy, entertainment',
        'Computer communication system',
        'Automatic, airplane, transportation',
        'Medical equipment',
        'Medicine, supplement, cosmetics',
        'Software · Web · App',//2
        'Web Services Media Promotion',
        'Game related',
        'Communication carrier, communication related',
        'Broadcasting, video, sound',//3
        'Newspapers, advertising, publishing, printing',
        'Design Art Events, Other',
        'Food and drink · others',//4
        'Hotel, Ryokan, Corner Funeral',
        'Travel and leisure amusement',
        'Beauty, Barber, Este, Health, Fitness',
        'Education and childcare',
        'Building Management, Maintenance, Security',
        'Department stores, GMS',//5
        'Super Convenience Stores, Grocery',
        'Drugstore and dispensing pharmacy',
        'Home appliances and mass retailers',
        'Fashion apparel sports',
        'Medical care',//6
        'Care, welfare, other',
        'Think tank marketing and survey',//7
        'Specialized consultant',
        'Verical work, personal office, other',
        'Environment and recycling',//8
        'Power, gas, energy, others'
    ];
}
