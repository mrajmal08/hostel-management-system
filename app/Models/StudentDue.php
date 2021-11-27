<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDue extends Model
{
    use HasFactory;
    protected $table = 'student_dues';
    protected $fillable = [
        'user_id',
        'fees',
        'date',
        'screen_shot',
        'status',
    ];
}
