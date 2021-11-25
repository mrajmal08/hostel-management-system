<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'contact',
        'city',
        'state',
        'country',

    ];
}
