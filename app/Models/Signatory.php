<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    use HasFactory;

        protected $fillable = ['profTitles', 'position', 'firstName', 'middleName', 'lastName'];

}
