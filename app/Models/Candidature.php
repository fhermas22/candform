<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'address',
        'cv_path',
    ];
}
