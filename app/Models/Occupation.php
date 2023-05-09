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
        'Consultant experts',//1
        'Management system',//2
        'Business staff',//3
        'Store, sales and service system',//4
        'Education, sports and civil servants',//5
        'IT / Web Service Games',//6
        'Video, Anime, Publishing, Creative',//7
        'Machine, electrical and electronic',//8
        'Medical, medicine, welfare',//9
        'Management and strategy consultant',//1
        'Financial and accounting consultants',
        'Technology / Professional Area Consultant',
        'Environmental survey, environmental analysis',
        'Lawyer, patent attorney',
        'Justice scrivener, administrative scrivener',
        'Other, National Qualification, Senior Qualification Professional',
        'General Affairs',//2
        'Human Resources, Labor',
        'Financial accounting',
        'Intellectual property, patent',
        'General Secretary',
        'Secretary',
        'Other, administrative administration',
        'Interpretation and translation',//3
        'Telemarketing, Customer Support',
        'Telephone operator, telephone aponor',
        'Merchandizer, buyer, purchase assessment',
        'Material, purchase',
        'Other, business staff',
        'Supervisor, store guidance',//4
        'Manager',
        'Hall staff, floor staff',
        'Sales, interpretation sales, sales floor',
        'Barber, Hairdresser',
        'Other travel, hotel bridal related',
        'Language teachers, teachers, teachers, instructors',//5
        'Educational management',
        'Nursery teacher, kindergarten teacher',
        'Sport instructor, athletes',
        'Public employee, group staff',
        'Other education, civil servants, sports',
        'IT consultant',//6
        'Architect Analyst Product Manager',
        'Web Producer Web Director UI / UX Design',
        'Research and patent engineer',
        'PM (Web, Mobile, App)',
        'Game creator',
        'Web designer',
        'Server engineer',
        'Network engineer',
        'QA Engineer, Test Engineer',
        'Other, IT / Web Services',
        'Graphic designer',//7
        'Illustrator, cartoonist',
        'Edit, editor, desk',
        'Production progress management',
        'Other video, events, entertainment related',
        'Electronic circuit design',//8
        'Research, patent, technical marketing',
        'Service engineer',
        'Other Electrical & Electronic Machily Engineers',
        'Doctor, dentist, nurse',//9
        'Counselor, clinical psychologist',
        'Medical office work',
        'Academic and Technical Support',
        'Other medical welfare work'
    ];
}
