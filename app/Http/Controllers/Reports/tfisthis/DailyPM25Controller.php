<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\PdfReport;
use App\Models\AirQualityData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyPM25Controller extends Controller
{
    public function index() {


        // Get daily averages for PM2.5 and PM10
        $dailyAverages = AirQualityData::select(
            DB::raw('DATE(dateTime) as date'),
            DB::raw('ROUND(AVG(pm25), 2) as pm25_average'),
            DB::raw('ROUND(AVG(pm10), 2) as pm10_average'),
            DB::raw('ROUND(AVG(co), 2) as co_average'),
            DB::raw('ROUND(AVG(no2), 2) as no2_average'),
            DB::raw('ROUND(AVG(ozone), 3) as ozone_average')

        )
        ->groupBy('date')
        ->get();

         // Get the minimum date from the dataset
        $minDate = $dailyAverages->min('date');

        // Format the minimum date into the desired format
        $formattedMinDate = Carbon::parse($minDate)->format('F d, Y');


        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();


        // First Page
        $fpdf->Image('airsense-prot.png', 15, 50, 180);          //x, y, size


        // Draw a white box inside the image
        $fpdf->SetFillColor(255, 255, 255, 127); // White color
        $fpdf->Rect(40, 210, 130, 50, 'F'); // x, y, w, h, 'F' indicates to fill the rectangle


        // Add the description inside the white box
        $today = date('Y'); // Get current year only (YYYY format)
        $description = "CY $today\nDAILY ASSESSMENT REPORT OF\nPM2.5 CONCENTRATION IN (UG/M^3) AT\nBUKIDNON STATE UNIVERSITY- (MAIN CAMPUS)\nIoT AIR QUALITY MONITORING STATION";
        $fpdf->SetFont('Arial', '', 13);
        $fpdf->SetXY(40 + 5, 210 + 5); // Adjust the position for the description
        $fpdf->MultiCell(130 - 10, 8, $description, 0, 'C');


        $fpdf->SetFont('Arial', 'B', 10);
        // second page
        $fpdf->Ln(240);
        // Second Page
        $fpdf->Ln(240); // because the image is not part of the text, we need this to jump to the second page


        $fpdf->Cell(0, 10, 'CY 2024-2025 Daily Assessment Report from AirSense IoT Monitoring Device', 0, 1, 'C');
        $fpdf->Cell(0, 0, 'PM2.5 Ambient Air Quality Monitoring Station', 0, 1, 'C');
        $fpdf->Ln(10);

        $fpdf->SetFont('Arial', '', 10);                                        // REMOVING THE BOLD STYLE
        $fpdf->Cell(25);                                                        // ACT AS A MARGIN-LEFT BUT ACTUALLY AN INVISIBLE CELL WITH A WIDTH OF 25pt
        $fpdf->Cell(40, 5, 'Station: ', 0, 0, 'L');                             // 40pt THE WIDTH I DECIDED FOR EVERY VISIBLE 2ND LEFT CELL
        $fpdf->Cell(100, 5, 'Bukidnon State University - Main Campus', 'B', 1); // JUST GOES ALONG WITH THE 1ST AND 2ND CELL       

        $fpdf->Cell(25);
        $fpdf->Cell(40, 5, 'Latitude: ', 0, 0, 'L');
        $fpdf->Cell(100, 5, 'Latitude: 8.157408, Longitude: 125.124856', 'B', 1);

        $fpdf->Cell(25);
        $fpdf->Cell(40, 5, 'Area Type: ', 0, 0, 'L');
        $fpdf->Cell(100, 5,'General Ambient', 'B', 1);

        $fpdf->Cell(25);
        $fpdf->Cell(40, 5, 'Station Type: ', 0, 0, 'L');
        $fpdf->Cell(100, 5, 'PM5003, MiCS6814 & MQ131 Sampler (Solar Paneled Sensor)', 'B', 1);

        $fpdf->Cell(25);
        $fpdf->Cell(40, 5, 'Inception Date: ', 0, 0, 'L');
        $fpdf->Cell(100, 5, $formattedMinDate, 'B', 1);

        $fpdf->Cell(25);
        $fpdf->Cell(40, 5, 'Monitoring Objectives: ', 0, 0, 'L');
        $fpdf->Cell(100, 5, 'To determine the concentration level of PM2.5', 'B', 1);

        $fpdf->Cell(25);    //INVISIBLE LEFT CELL WITH A WIDTH OF 25 AS A MARGIN
        $fpdf->Cell(40, 5, 'Measures Air Pollutant: ', 0, 0, 'L');      //42pt THE WIDTH I DECIDED FOR EVERY VISIBLE 2ND LEFT CELL
        $fpdf->Cell(100, 5, 'Micrograms per cubic meter (ug/m3)', 'B', 1,);    //JUST GOES ALONG WITH THE 1ST AND 2ND CELL       

        $fpdf->LN(5);       //NEW LINE  5pt

        // PM2.5 START
        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'PM2.5 Concentration in (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(40, 10, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 10, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers


        //Table Body
        // 1ST WEEK
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        //3rd week    
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(60, 10, '14', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        // PM2.5 END


    // Get today's date
    $today = date('Y'); // Get current year only (YYYY format)
    // $nextYear = $today + 1; // Add 1 to get next year
    $fpdf->Output('I', "AirSense $today Monthly_Assessment.pdf");
    exit;
    }


}
