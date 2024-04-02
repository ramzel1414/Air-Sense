<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirQualityData;

class AirQualityDataController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'sender' => 'required|string',
            'message' => 'required|string',
            'dateTime' => 'required|date', // Add validation for dateTimeSent
        ]);

        // Parse message and extract air quality data
        $message = $data['message'];
        preg_match('/PM2.5: ([\d.]+)ug\/m3\nPM10: ([\d.]+) ug\/m3\nCO: ([\d.]+) ppm\nNO2: ([\d.]+) ppm\nOzone: ([\d.]+)/', $message, $matches);

                $dateTime = date('Y-m-d H:i:s', strtotime($data['dateTime']));


        // Save data to the database
        AirQualityData::create([
            'sender' => $data['sender'],
            'pm10' => $matches[2],
            'pm25' => $matches[1],
            'co' => $matches[3],
            'no2' => $matches[4],
            'ozone' => $matches[5],
            'dateTime' => $dateTime,
        ]);

        return response()->json(['message' => 'Air quality data saved successfully']);
    }
}
