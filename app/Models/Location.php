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
        1 => 'An Giang',
        2 => 'Bà Rịa-Vũng Tàu',
        3 => 'Bạc Liêu',
        4 => 'Bắc Kạn',
        5 => 'Bắc Giang',
        6 => 'Bắc Ninh',
        7 => 'Bến Tre',
        8 => 'Bình Dương',
        9 => 'Bình Định',
        10 => 'Bình Phước',
        11 => 'Bình Thuận',
        12 => 'Cà Mau',
        13 => 'Cao Bằng',
        14 => 'Cần Thơ',
        15 => 'Đà Nẵng',
        16 => 'Đắk Lắk',
        17 => 'Đắk Nông',
        18 => 'Điện Biên',
        19 => 'Đồng Nai',
        20 => 'Đồng Tháp',
        21 => 'Gia Lai',
        22 => 'Hà Giang',
        23 => 'Hà Nam',
        24 => 'Hà Nội',
        25 => 'Hà Tây',
        26 => 'Hà Tĩnh',
        27 => 'Hải Phòng',
        28 => 'Hải Dương',
        29 => 'Hòa Bình',
        30 => 'Hồ Chí Minh',
        31 => 'Hậu Giang',
        32 => 'Hưng Yên',
        33 => 'Khánh Hòa',
        34 => 'Kiên Giang',
        35 => 'Kon Tum',
        36 => 'Lai Châu',
        37 => 'Lào Cai',
        38 => 'Lạn Sơn',
        39 => 'Lâm Đồng',
        40 => 'Long An',
        41 => 'Nam Định',
        42 => 'Nghệ An',
        43 => 'Ninh Bình',
        44 => 'Ninh Thuận',
        45 => 'Phú Thọ',
        46 => 'Phú Yên',
        47 => 'Quảng Bình',
        48 => 'Quảng Nam',
        49 => 'Quảng Ngãi',
        50 => 'Quảng Ninh',
        51 => 'Quảng Trị',
        52 => 'Sóc Trăng',
        53 => 'Sơn La',
        54 => 'Tây Ninh',
        55 => 'Thái Bình',
        56 => 'Thái Nguyên',
        57 => 'Thanh Hóa',
        58 => 'Thừa Thiên-Huế',
        59 => 'Tiền Giang',
        60 => 'Trà Vinh',
        61 => 'Tuyên Quang',
        62 => 'Vĩnh Long',
        63 => 'Vĩnh Phúc',
        64 => 'Yên Bái'
    ];

    public static $famous = [24, 27, 15, 30, 1, 8, 12 , 14, 19, 21, 33, 38, 42, 45, 48, 58];
}
