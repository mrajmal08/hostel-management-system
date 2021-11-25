<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookHostel extends Model
{
    use HasFactory;
    protected $table = 'hostel_booking';
    protected $fillable = [
        'user_id',
        'room_id',
        'course_id',
        'food_status',
        'stay_from',
        'total_amount',
        'emergency_contact',
        'guardian_name',
        'guardian_relation',
        'guardian_contact',
        'address',
        'zip_code',
        'city',
        'state',

    ];
}
