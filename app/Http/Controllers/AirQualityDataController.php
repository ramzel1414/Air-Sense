<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirQualityData;

class AirQualityDataController extends Controller
{
    // Function to get PM2.5 data from the database
    public function getPM25Data(){
        $pm25Data = AirQualityData::select('dateTime', 'pm25')->get();
        return response()->json($pm25Data);
    }

        // Function to get PM10 data from the database
    public function getPM10Data(){
        $pm10Data = AirQualityData::select('dateTime', 'pm10')->get();
        return response()->json($pm10Data);
    }

    public function getCOData(){
        $coData = AirQualityData::select('dateTime', 'co')->get();
        return response()->json($coData);
    }

    public function getNO2Data(){
        $no2Data = AirQualityData::select('dateTime', 'no2')->get();
        return response()->json($no2Data);
    }

    public function getO3Data(){
        $O3Data = AirQualityData::select('dateTime', 'ozone')->get();
        return response()->json($O3Data);
    }

    // Function to store new air quality data
    public function store(Request $request){
        $data = $request->validate([
            'sender' => 'required|string',
            'message' => 'required|string',
            'dateTime' => 'required|date', // Add validation for dateTimeSent
        ]);

        $message = $data['message'];
        preg_match('/PM2.5: ([\d.]+)ug\/m3\nPM10: ([\d.]+) ug\/m3\nCO: ([\d.]+) ppm\nNO2: ([\d.]+) ppm\nOzone: ([\d.]+)/', $message, $matches);
        $dateTime = date('Y-m-d H:i:s', strtotime($data['dateTime']));

        AirQualityData::create([
            'sender' => $data['sender'],
            'pm10' => $matches[2],
            'pm25' => $matches[1],
            'co' => $matches[3],
            'no2' => $matches[4],
            'ozone' => $matches[5],
            'dateTime' => $dateTime,
        ]);
    }
}
