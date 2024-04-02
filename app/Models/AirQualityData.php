<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirQualityData extends Model
{
    use HasFactory;
    protected $fillable = ['sender', 'pm10', 'pm25', 'co', 'no2', 'ozone', 'dateTime'] ;

}
