<?php

namespace App\Models;

use App\Models\Relationships\OccupationRelationship;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use OccupationRelationship;

    protected $table = 'occupations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id'
    ];

    public static $name = [
        'Consultant experts' => null,//1
        'Management system' => null,//2
        'Business staff' => null,//3
        'Store, sales and service system' => null,//4
        'Education, sports and civil servants' => null,//5
        'IT / Web Service Games' => null,//6
        'Video, Anime, Publishing, Creative' => null,//7
        'Machine, electrical and electronic' => null,//8
        'Medical, medicine, welfare' => null,//9
        'Management and strategy consultant' => 1,//1
        'Financial and accounting consultants' => 1,
        'Technology / Professional Area Consultant' => 1,
        'Environmental survey, environmental analysis' => 1,
        'Lawyer, patent attorney' => 1,
        'Justice scrivener, administrative scrivener' => 1,
        'Other, National Qualification, Senior Qualification Professional' => 1,
        'General Affairs' => 2,//2
        'Human Resources, Labor' => 2,
        'Financial accounting' => 2,
        'Intellectual property, patent' => 2,
        'General Secretary' => 2,
        'Secretary' => 2,
        'Other, administrative administration' => 2,
        'Interpretation and translation' => 3,//3
        'Telemarketing, Customer Support' => 3,
        'Telephone operator, telephone aponor' => 3,
        'Merchandizer, buyer, purchase assessment' => 3,
        'Material, purchase' => 3,
        'Other, business staff' => 3,
        'Supervisor, store guidance' => 4,//4
        'Manager' => 4,
        'Hall staff, floor staff' => 4,
        'Sales, interpretation sales, sales floor' => 4,
        'Barber, Hairdresser' => 4,
        'Other travel, hotel bridal related' => 4,
        'Language teachers, teachers, teachers, instructors' => 5,//5
        'Educational management' => 5,
        'Nursery teacher, kindergarten teacher' => 5,
        'Sport instructor, athletes' => 5,
        'Public employee, group staff' => 5,
        'Other education, civil servants, sports' => 5,
        'IT consultant' => 6,//6
        'Architect Analyst Product Manager' => 6,
        'Web Producer Web Director UI / UX Design' => 6,
        'Research and patent engineer' => 6,
        'PM (Web, Mobile, App)' => 6,
        'Game creator' => 6,
        'Web designer' => 6,
        'Server engineer' => 6,
        'Network engineer' => 6,
        'QA Engineer, Test Engineer' => 6,
        'Other, IT / Web Services' => 6,
        'Graphic designer' => 7,//7
        'Illustrator, cartoonist' => 7,
        'Edit, editor, desk' => 7,
        'Production progress management' => 7,
        'Other video, events, entertainment related' => 7,
        'Electronic circuit design' => 8,//8
        'Research, patent, technical marketing' => 8,
        'Service engineer' => 8,
        'Other Electrical & Electronic Machily Engineers' => 8,
        'Doctor, dentist, nurse' => 9,//9
        'Counselor, clinical psychologist' => 9,
        'Medical office work' => 9,
        'Academic and Technical Support' => 9,
        'Other medical welfare work' => 9
    ];
}
