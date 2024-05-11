<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student';
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email_id',
        'date_of_birth',
        'standard',
        'gender',
        'entry_year',
        'profile',
    ];

    protected $dates = ['date_of_birth']; // Define columns which should be treated as dates

    protected $casts = [
        'gender' => 'string', // Cast the gender field as string
    ];
}