<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\PdfReport;
use App\Models\AirQualityData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PdfController extends Controller
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
        $description = "CY $today\nOVERALL ASSESSMENT REPORT OF BUKIDNON STATE UNIVERSITY- (MAIN CAMPUS)\nIoT AIR QUALITY MONITORING STATION\n(PM2.5, PM10, CO, NO2, AND O3)";
        $fpdf->SetFont('Arial', '', 13);
        $fpdf->SetXY(40 + 5, 210 + 5); // Adjust the position for the description
        $fpdf->MultiCell(130 - 10, 8, $description, 0, 'C');


        $fpdf->SetFont('Arial', 'B', 10);
        // second page
        $fpdf->Ln(240);
        // Second Page
        $fpdf->Ln(240); // because the image is not part of the text, we need this to jump to the second page


        $fpdf->Cell(0, 10, 'CY 2024-2025 Assessment Report from AirSense IoT Monitoring Device', 0, 1, 'C');
        $fpdf->Cell(0, 0, 'PM2.5, PM10, O3, CO & NO2 Ambient Air Quality Monitoring Station', 0, 1, 'C');
        $fpdf->Ln(10);

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(20);    //serves as margin (actually a width of invisible cell)
        $fpdf->Cell(0, 10, 'Station: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'Bukidnon State University - Main Campus                                                             ', 0, 1, 'R');
        $fpdf->Cell(20);
        $fpdf->Cell(0, 0, 'Latitude: ', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'Latitude: 8.157408, Longitude: 125.124856                                                           ', 0, 1, 'R');

        $fpdf->Cell(20);
        $fpdf->Cell(0, 10, 'Area Type: ', 0, 0, 'L');
        $fpdf->Cell(0, 10,'General Ambient                                                                                                     ', 0, 1, 'R');

        $fpdf->Cell(20);
        $fpdf->Cell(0, 0, 'Station Type:', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'PM5003, MiCS6814 & MQ131 Sampler (Solar Paneled Sensor)                          ', 0, 1, 'R');

        $fpdf->Cell(20);
        $fpdf->Cell(0, 10, 'Inception Date: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, $formattedMinDate . '                                                                                                         ', 0, 1, 'R');
        $fpdf->Cell(20);
        $fpdf->Cell(0, 0, 'Monitoring Objectives: ', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'To determine the concentration level of PM2.5, PM10, O3, CO & NO2                 ', 0, 1, 'R');
        $fpdf->Cell(20);
        $fpdf->Cell(0, 10, 'Measures Air Pollutant: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'Micrograms per cubic meter (ug/m3), Parts per million (ppm),                              ', 0, 1, 'R');
        $fpdf->LN(5);





        // Pollutant Classification
        $fpdf->SetFont('Arial', 'B', 12);

        $fpdf->Cell(0, 10, 'Pollutant Classifications', 0, 0, 'C');

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Ln(12);
        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        $fpdf->SetFillColor(197, 206, 209); // Light grey color
        $fpdf->Cell(32, 10, 'CATEGORY', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, 'COLOR', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, 'PM10 (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, 'PM2.5 (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, 'CO (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, 'NO2 (ppm)', 1, 1, 'C', true);

        // Table Body
        $fpdf->SetFont('Arial', '', 10);

        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Good
        $fpdf->Cell(32, 10, 'Good', 1, 0, 'C');
        $fpdf->SetFillColor(111, 241, 117); // Light green color
        $fpdf->Cell(32, 10, 'Green', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, '0 - 54', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0 - 25', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0 - 25', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0 - 0.05', 1, 1, 'C');


        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Fair
        $fpdf->Cell(32, 10, 'Moderate', 1, 0, 'C');
        $fpdf->SetFillColor(255, 255, 77); // Light yellow color
        $fpdf->Cell(32, 10, 'Yellow', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, '55 - 154', 1, 0, 'C');
        $fpdf->Cell(32, 10, '25.1 - 35.0', 1, 0, 'C');
        $fpdf->Cell(32, 10, '25 - 50', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0.06 - 0.10', 1, 1, 'C');

        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Orange
        $fpdf->Cell(32, 10, 'Acutely Unhealthy', 1, 0, 'C');
        $fpdf->SetFillColor(250, 123, 91); // Light orange color
        $fpdf->Cell(32, 10, 'Orange', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, '155 - 254', 1, 0, 'C');
        $fpdf->Cell(32, 10, '35.1 - 45.0', 1, 0, 'C');
        $fpdf->Cell(32, 10, '51 - 69', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0.11 - 0.36', 1, 1, 'C');

        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Unhealthy
        $fpdf->Cell(32, 10, 'Unhealthy', 1, 0, 'C');
        $fpdf->SetFillColor(253, 93, 114); // Light red color
        $fpdf->Cell(32, 10, 'Red', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, '255 - 354', 1, 0, 'C');
        $fpdf->Cell(32, 10, '45.1 - 55', 1, 0, 'C');
        $fpdf->Cell(32, 10, '70 - 150', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0.37 - 0.65', 1, 1, 'C');

        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Very Unhealthy
        $fpdf->Cell(32, 10, 'Very Unhealthy', 1, 0, 'C');
        $fpdf->SetFillColor(127, 88, 151); // Light purple color
        $fpdf->Cell(32, 10, 'Purple', 1, 0, 'C', true);
        $fpdf->Cell(32, 10, '355 - 424', 1, 0, 'C');
        $fpdf->Cell(32, 10, '55.1 - 90', 1, 0, 'C');
        $fpdf->Cell(32, 10, '151 - 400', 1, 0, 'C');
        $fpdf->Cell(32, 10, '0.66 - 1.24', 1, 1, 'C');

        $fpdf->Cell(1); // An Empty cell to push the table(row) to center
        // Hazardous
        $fpdf->Cell(32, 10, 'Hazardous', 1, 0, 'C');
        $fpdf->SetTextColor(255, 255, 255); // Set text color to white
        $fpdf->SetFillColor(128, 0, 0); // maroon color
        $fpdf->Cell(32, 10, 'Maroon', 1, 0, 'C', true);
        $fpdf->SetTextColor(0, 0, 0); // Reset text color to black
        $fpdf->Cell(32, 10, '425 - 504', 1, 0, 'C');
        $fpdf->Cell(32, 10, 'Above 91', 1, 0, 'C');
        $fpdf->Cell(32, 10, 'Above 401', 1, 0, 'C');
        $fpdf->Cell(32, 10, 'Above 1.24', 1, 1, 'C');


        // POLLUTANT INFORMATION
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 10, 'Pollutant Information', 0, 0, 'C');

        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Ln(12);
        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        $fpdf->SetFillColor(197, 206, 209); // Light grey color
        $fpdf->Cell(40, 10, 'POLLUTANT', 1, 0, 'C', true);
        $fpdf->Cell(150, 10, 'INFORMATION', 1, 1, 'C', true);

        // Table Body
        $fpdf->SetFont('Arial', '', 10);

        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        // PM10
        $fpdf->Cell(40, 10, 'Particulate Matter 2.5', 1, 0, 'C');
        $fpdf->Cell(150, 10, 'These particles can include dust, pollen, mold spores, and other airborne pollutants.', 1, 1, 'L');
        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        // PM2.5
        $fpdf->Cell(40, 10, 'Particulate Matter 10', 1, 0, 'C');
        $fpdf->Cell(150, 10, 'These particles can penetrate deep into the lungs and even enter the bloodstream.', 1, 1, 'L');
        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        // PM2.5
        $fpdf->Cell(40, 10, 'Carbon Monoxide', 1, 0, 'C');
        $fpdf->Cell(150, 10, 'A colorless, odorless, toxic gas produced by incomplete combustion of carbon-containing fuels.', 1, 1, 'L');
        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        // PM2.5
        $fpdf->Cell(40, 10, 'Nitrogen Dioxide', 1, 0, 'C');
        $fpdf->Cell(150, 10, 'Formed primarily from combustion processes, particularly from vehicles and industrial activities.', 1, 1, 'L');
        $fpdf->Cell(2); // An Empty cell to push the table(row) to center
        // PM2.5
        $fpdf->Cell(40, 10, 'Ozone', 1, 0, 'C');
        $fpdf->Cell(150, 10, 'A pollutant that negatively impacting respiratory health and worsening lung conditions', 1, 1, 'L');



        // POLLUTANT TABLE (NEW)
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'PM2.5 Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // PM2.5 START
        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'PM2.5 Concentration in (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers
        $fpdf->Cell(45); // An Empty cell to push the 3 subheaders just below the main header
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);

        //Table Body
        // 1ST WEEK
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 140, '14', 1, 0, 'C');      //monthly here
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        // PM2.5 CONTINUATION
        //3rd week
        $fpdf->ln(100);     //force next page after two weeks or 14 days (14 rows)
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'PM2.5 Pollutant Table Cont.', 0, 1, 'C');
        $fpdf->ln(5);

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 160, '14', 1, 0, 'C');       //monthly here continuation
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 10, '', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 10, '', 1, 0, 'C');
        $fpdf->Cell(20); // An Empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        // PM2.5 END


        // PM10 START

        $fpdf->ln(100); //force next page
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'PM10 Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color for the header
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'PM10 Concentration in (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers
        $fpdf->Cell(45); // An Empty cell to push the 3 subheaders just below the main header
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);

        //Table Body
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //monthly here      (70 = 7 rows temp)
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->ln(200); //force next page

        // CO START

        $fpdf->ln(100); //force next page
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'CO Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color for the header
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'CO Concentration in (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers
        $fpdf->Cell(45); // An Empty cell to push the 3 subheaders just below the main header
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);

        //Table Body
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //monthly here      (70 = 7 rows temp)
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->ln(200); //force next page

        // NO2 START

        $fpdf->ln(100); //force next page
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'NO2 Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color for header
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'NO2 Concentration in (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers
        $fpdf->Cell(45); // An Empty cell to push the 3 subheaders just below the main header
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);

        //Table Body
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //monthly here      (70 = 7 rows temp)
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->ln(200); //force next page

        // O3 START

        $fpdf->ln(100); //force next page
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'O3 Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color for the header
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'O3 Concentration in (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10); // Move to the next line for sub-headers
        $fpdf->Cell(45); // An Empty cell to push the 3 subheaders just below the main header
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);

        //Table Body
        $fpdf->SetFillColor(111, 241, 117);     //green background, just add a 7th parameter (true)

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //weekly here
        $fpdf->Cell(20, 70, '14', 1, 0, 'C');       //monthly here      (70 = 7 rows temp)
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);

        $fpdf->Cell(5); // An Empty cell to push the row to right
        $fpdf->Cell(40, 10, '2024-04-26', 1, 0, 'C');
        $fpdf->Cell(20, 10, '14', 1, 0, 'C');
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(20);                          //an empty cell to fill up the space
        $fpdf->Cell(40, 10, 'Within Guideline Value', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Good', 1, 1, 'C', true);


        //NAMES AND SIGNATURE
        $fpdf->ln(15); //gap or margin top (new line)
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 10, 'Prepared by:', 0, 0, 'L');
        $fpdf->Cell(20, 10, 'Reviewed by:', 0, 1, 'L');
        $fpdf->ln(20);

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'ENGR. RAMON PAULO A. CAUMBAN', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'ENGR. RAYGIE ARVY B. GANTE', 0, 1, 'L');

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'Project Document Specialist', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'Senior Environmental Specialist', 0, 1, 'L');

        $fpdf->ln(5);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 10, 'Checked by:', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'Recommended by:', 0, 1, 'L');
        $fpdf->ln(20);

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'ENGR. DJEIKUJE NICKOLAI C. GACUS', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'ENGR. BRIGITTE A. DEEHAY', 0, 1, 'L');

        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'Chief, Ambient Monitoring and Forcasting Section', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'Chief, Environmental Documentation Station', 0, 1, 'L');









        // POLLUTANT TABLE BEFORE CAPSTONE DEFENSE
        // First batch table header
        $fpdf->Ln(100);
        $fpdf->AddPage('P');
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');

        $fpdf->Cell(0, 10, 'Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230); // Light blue color
        $fpdf->Cell(30, 10, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(30, 10, 'PM2.5 (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'Classification', 1, 0, 'C', true);
        $fpdf->Cell(30, 10, 'PM10 (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'Classification', 1, 1, 'C', true);

        $fpdf->SetFont('Arial','', 10);
        // Populate table with daily average data
        foreach ($dailyAverages as $average) {
            $date = $average->date;
            $pm25Average = $average->pm25_average;
            $pm10Average = $average->pm10_average;

            // Get classification and color for PM2.5
            $pm25Classification = $this->getClassificationPM25($pm25Average);
            $pm25Color = $this->getColor($pm25Classification); // Get PM2.5 color

            // Get classification and color for PM10
            $pm10Classification = $this->getClassificationPM10($pm10Average);
            $pm10Color = $this->getColor($pm10Classification); // Get PM10 color

            // Add row to table with colored cells
            $fpdf->Cell(30, 10, $date, 1, 0, 'C');
            $fpdf->SetFillColor($pm25Color[0], $pm25Color[1], $pm25Color[2]);
            $fpdf->Cell(30, 10, number_format($pm25Average, 0), 1, 0, 'C', false, '', $pm25Color); // Display PM2.5 without decimal places
            $fpdf->CellFitScale(25, 10, $pm25Classification, 1, 0, 'C', true);

            $fpdf->SetFillColor($pm10Color[0], $pm10Color[1], $pm10Color[2]);
            $fpdf->Cell(30, 10, number_format($pm10Average, 0), 1, 0, 'C', false, '', $pm10Color);
            $fpdf->CellFitScale(25, 10, $pm10Classification, 1, 1, 'C', true);
        }

        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230);
        $fpdf->Cell(35, 10, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'CO (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(27, 10, 'Classification', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'NO2 (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(27, 10, 'Classification', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'Ozone (ppm)', 1, 0, 'C', true);
        $fpdf->Cell(27, 10, 'Classification', 1, 1, 'C', true);

        $fpdf->SetFont('Arial', '', 10);
        foreach ($dailyAverages as $average2) {
            $date = $average2->date;
            $coAverage = $average2->co_average;
            $no2Average = $average2->no2_average;
            $ozoneAverage = $average2->ozone_average;

            $COClassification = $this->getClassificationCO($coAverage);
            $COColor = $this->getColor($COClassification);

            $NO2Classification = $this->getClassificationNO2($no2Average);
            $NO2Color = $this->getColor($NO2Classification);

            $OzoneClassification = $this->getClassificationOzone($ozoneAverage);
            $OzoneColor = $this->getColor($OzoneClassification);

            $fpdf->Cell(35, 10, $date, 1, 0, 'C', false);
            $fpdf->SetFillColor($COColor[0], $COColor[1], $COColor[2]);
            $fpdf->Cell(25, 10, number_format($coAverage, 0), 1, 0, 'C', false, '', $COColor);
            $fpdf->CellFitScale(27, 10, $COClassification, 1, 0, 'C', true);

            $fpdf->SetFillColor($NO2Color[0], $NO2Color[1], $NO2Color[2]);
            $fpdf->Cell(25, 10, number_format($no2Average, 2), 1, 0, 'C', false, '', $NO2Color);
            $fpdf->CellFitScale(27, 10, $NO2Classification, 1, 0, 'C', true);

            $fpdf->SetFillColor($OzoneColor[0], $OzoneColor[1], $OzoneColor[2]);
            $fpdf->Cell(25, 10, number_format($ozoneAverage, 3), 1, 0, 'C', false, '', $OzoneColor);
            $fpdf->CellFitScale(27, 10, $OzoneClassification, 1, 1, 'C', true);
        }





    // Get today's date
    $today = date('Y'); // Get current year only (YYYY format)
    // $nextYear = $today + 1; // Add 1 to get next year
    $fpdf->Output('I', "AirSense $today Monthly_Assessment.pdf");
    exit;
    }

    private function getClassificationPM25($value)
    {
        // Define PM2.5 classification rules
        if ($value >= 0 && $value <= 25) {
            return "Good";
        } elseif ($value > 25 && $value <= 35) {
            return "Moderate";
        } elseif ($value > 35 && $value <= 45) {
            return "Slightly Unhealthy";
        } elseif ($value > 45 && $value <= 55) {
            return "Unhealthy";
        } elseif ($value > 55 && $value <= 90) {
            return "Acutely Unhealthy";
        } elseif ($value > 90) {
            return "Hazardous";
        } else {
            return "Unknown Classification";
        }
    }

    private function getClassificationPM10($value)
    {
        // Define PM10 classification rules
        if ($value >= 0 && $value <= 54) {
            return "Good";
        } elseif ($value > 54 && $value <= 154) {
            return "Moderate";
        } elseif ($value > 154 && $value <= 254) {
            return "Slightly Unhealthy";
        } elseif ($value > 254 && $value <= 354) {
            return "Unhealthy";
        } elseif ($value > 354 && $value <= 424) {
            return "Acutely Unhealthy";
        } elseif ($value > 424) {
            return "Hazardous";
        } else {
            return "Unknown Classification";
        }
    }

    private function getClassificationCO($value) {
        // Define CO classification rules
        if ($value >= 0 && $value <= 25) {
            return "Good";
        } elseif ($value > 25 && $value <= 50) {
            return "Moderate";
        } elseif ($value > 50 && $value <= 69) {
            return "Slightly Unhealthy";
        } elseif ($value > 69 && $value <= 150) {
            return "Unhealthy";
        } elseif ($value > 150 && $value <= 400) {
            return "Acutely Unhealthy";
        } elseif ($value > 400) {
            return "Hazardous";
        } else {
            return "Unknown Classification";
        }
    }

    private function getClassificationNO2($value) {
        // Define NO2 classification rules
        if ($value >= 0 && $value <= 0.05) {
            return "Good";
        } elseif ($value > 0.05 && $value <= 0.10) {
            return "Moderate";
        } elseif ($value > 0.10 && $value <= 0.36) {
            return "Slightly Unhealthy";
        } elseif ($value > 0.36 && $value <= 0.65) {
            return "Unhealthy";
        } elseif ($value > 0.65 && $value <= 1.24) {
            return "Acutely Unhealthy";
        } elseif ($value > 1.24) {
            return "Hazardous";
        } else {
            return "Unknown Classification";
        }
    }

    private function getClassificationOzone($value) {
        // Define Ozone classification rules
        if ($value >= 0 && $value <= 0.064) {
            return "Good";
        } elseif ($value > 0.064 && $value <= 0.084) {
            return "Moderate";
        } elseif ($value > 0.084 && $value <= 0.104) {
            return "Slightly Unhealthy";
        } elseif ($value > 0.104 && $value <= 0.124) {
            return "Unhealthy";
        } elseif ($value > 0.124 && $value <= 0.374) {
            return "Acutely Unhealthy";
        } elseif ($value > 0.374) {
            return "Hazardous";
        } else {
            return "Unknown Classification";
        }
    }

    private function getColor($classification)
    {
        // Define color mappings based on classification
        switch ($classification) {
            case "Good":
                return [111, 241, 117];
            case "Moderate":
                return [255, 255, 77];
            case "Slightly Unhealthy":
                return [250, 123, 91];
            case "Unhealthy":
                return [253, 93, 114];
            case "Acutely Unhealthy":
                return [127, 88, 151];
            case "Hazardous":
                return [128, 0, 0];
            default:
                return [142, 86, 81];
        }
    }

}
