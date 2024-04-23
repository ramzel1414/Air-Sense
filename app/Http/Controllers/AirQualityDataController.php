<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirQualityData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\Storage;


class AirQualityDataController extends Controller
{
    public function getPM25Data(){
        $pm25Data = AirQualityData::select('dateTime', 'pm25')->get();
        return response()->json($pm25Data);
    }

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

    public function getOzoneData(){
        $O3Data = AirQualityData::select('dateTime', 'ozone')->get();
        return response()->json($O3Data);
    }

    // Function to store new air quality data
        public function store(Request $request){
        $data = $request->validate([
            'sender' => 'required|string',
            'message' => 'required|string',
            'dateTime' => 'required|date',
        ]);

        $message = $data['message'];
        preg_match('/PM2.5: ([\d.]+)ug\/m3\nPM10: ([\d.]+) ug\/m3\nCO: ([\d.]+) ppm\nNO2: ([\d.]+) ppm\nOzone: ([\d.]+)/', $message, $matches);
        $dateTime = date('Y-m-d H:i:s', strtotime($data['dateTime']));

        // Ensure ozone value is stored as a float with three decimal places
        $ozone = number_format((float) $matches[5], 3, '.', '');

        // Create a new record in the AirQualityData model
        AirQualityData::create([
            'sender' => $data['sender'],
            'pm10' => $matches[2],
            'pm25' => $matches[1],
            'co' => $matches[3],
            'no2' => $matches[4],
            'ozone' => $ozone, // Store the formatted ozone value
            'dateTime' => $dateTime,
        ]);
    }

    public function getPM25FCSV()
    {
        $csvPath = storage_path('Data/average_pm25_per_day_2024.csv');

        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Assumes first row is header

        $records = $csv->getRecords(); // Get all CSV records

        $data = [];

        foreach ($records as $record) {
            $date = $record['Date'];
            $pm25Value = number_format((float) $record['Average PM2.5'], 2); // Limit to 2 decimal places

            $data[] = [
                'Date' => $date,
                'ForecastPM25' => $pm25Value,
            ];
        }

        return response()->json($data);
    }

    public function getPM10FCSV()
    {
        $csvPath = storage_path('Data/average_pm10_per_day_2024.csv');

        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0); // Assumes first row is header

        $records = $csv->getRecords(); // Get all CSV records

        $data = [];

        foreach ($records as $record) {
            $date = $record['Date'];
            $pm10Value = number_format((float) $record['Average PM10'], 2); // Limit to 2 decimal places


            $data[] = [
                'Date' => $date,
                'ForecastPM10' => $pm10Value,
            ];
        }

        return response()->json($data);
    }
}
