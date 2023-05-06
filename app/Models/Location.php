<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static $name = [
        'An Giang',
        'Bà Rịa-Vũng Tàu',
        'Bạc Liêu',
        'Bắc Kạn',
        'Bắc Giang',
        'Bắc Ninh',
        'Bến Tre',
        'Bình Dương',
        'Bình Định',
        'Bình Phước',
        'Bình Thuận',
        'Cà Mau',
        'Cao Bằng',
        'Cần Thơ',
        'Đà Nẵng',
        'Đắk Lắk',
        'Đắk Nông',
        'Điện Biên',
        'Đồng Nai',
        'Đồng Tháp',
        'Gia Lai',
        'Hà Giang',
        'Hà Nam',
        'Hà Nội',
        'Hà Tây',
        'Hà Tĩnh',
        'Hải Phòng',
        'Hải Dương',
        'Hòa Bình',
        'Hồ Chí Minh',
        'Hậu Giang',
        'Hưng Yên',
        'Khánh Hòa',
        'Kiên Giang',
        'Kon Tum',
        'Lai Châu',
        'Lào Cai',
        'Lạn Sơn',
        'Lâm Đồng',
        'Long An',
        'Nam Định',
        'Nghệ An',
        'Ninh Bình',
        'Ninh Thuận',
        'Phú Thọ',
        'Phú Yên',
        'Quảng Bình',
        'Quảng Nam',
        'Quảng Ngãi',
        'Quảng Ninh',
        'Quảng Trị',
        'Sóc Trăng',
        'Sơn La',
        'Tây Ninh',
        'Thái Bình',
        'Thái Nguyên',
        'Thanh Hóa',
        'Thừa Thiên-Huế',
        'Tiền Giang',
        'Trà Vinh',
        'Tuyên Quang',
        'Vĩnh Long',
        'Vĩnh Phúc',
        'Yên Bái'
    ];

    public static $famous = [24, 27, 15, 30, 1, 8, 12 , 14, 19, 21, 33, 38, 42, 45, 48, 58];
}
