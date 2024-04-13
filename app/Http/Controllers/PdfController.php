<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\PdfReport;

class PdfController extends Controller
{
    public function index() {
        $fpdf = new PdfReport('P','mm','A4');
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Ln(10);
        $fpdf->Cell(0, 0, 'CY 2024 Annual Assessment Report of GAISANO MALAYBALAY CITY', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'PM2.5 Ambient Air Quality Monitoring Station', 0, 1, 'C');
        
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(50, 10, '                    Station: ', 0, 0, 'L');      
        $fpdf->Cell(0, 10, 'Gaisano Malaybalay City AQMS                                                                            ', 0, 1, 'R');
        $fpdf->Cell(0, 0, '                    Location: ', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'Baragay Something St Malaybalay City                                                                 ', 0, 1, 'R');
        $fpdf->Cell(0, 10, '                    Area Type: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'General Ambient                                                                                                    ', 0, 1, 'R');
        $fpdf->Cell(0, 0, '                    Station Type:', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'Manual PM2.5 Sampler (Mesa Labs BGI PQ200/MetOne EFRM-DC)                  ', 0, 1, 'R');
        $fpdf->Cell(0, 10, '                    Inception Date: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'March 29, 2024                                                                                                      ', 0, 1, 'R');
        $fpdf->Cell(0, 0, '                    Monitoring Objectives: ', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'To determine the general background concentration of PM2.5                             ', 0, 1, 'R');
        $fpdf->Cell(0, 10, '                    Measures Pollutant: ', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'Particulate Matter 2.5 (PM2.5)                                                                               ', 0, 1, 'R');
        $fpdf->Cell(0, 0, '                    Scale Representativeness: ', 0, 0, 'L');
        $fpdf->Cell(0, 0, 'Microscale to Middle Scale                                                                                    ', 0, 1, 'R');
        

//Table start

// First batch table header
$fpdf->Ln(10);
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->SetFillColor(173, 216, 230); // Light blue color
$fpdf->Cell(40, 10, 'Date of Sampling', 1, 0, 'C', true);
$fpdf->Cell(40, 10, 'PM2.5 (µg/m²)', 1, 0, 'C', true);
$fpdf->Cell(35, 10, 'Remarks', 1, 0, 'C', true);
$fpdf->Cell(40, 10, 'PM10 (µg/m²)', 1, 0, 'C', true);
$fpdf->Cell(35, 10, 'Remarks', 1, 1, 'C', true);

// First batch of data
$firstBatchData = [
    ['2024-03-01', '25', 'Normal', '50', 'Normal'],
    ['2024-03-02', '30', 'Normal', '55', 'Normal'],
    ['2024-03-03', '35', 'Moderate', '60', 'Moderate'],
    ['2024-03-04', '35', 'Moderate', '60', 'Moderate'],
    ['2024-03-05', '35', 'High', '60', 'Moderate'],
    ['2024-03-06', '35', 'High', '60', 'Moderate'],
    ['2024-03-07', '25', 'Normal', '50', 'Normal'],
    ['2024-03-08', '30', 'Normal', '55', 'Normal'],
    ['2024-03-09', '35', 'Moderate', '60', 'Moderate'],
    ['2024-03-10', '35', 'Moderate', '60', 'Moderate'],
    ['2024-03-11', '35', 'High', '60', 'Moderate'],
    ['2024-03-12', '35', 'High', '60', 'Moderate'],
    ['2024-03-13', '35', 'Moderate', '60', 'Moderate'],
    ['2024-03-14', '35', 'Moderate', '60', 'Moderate'],
];

// Populate first batch table with dummy data
foreach ($firstBatchData as $row) {
    $fpdf->Cell(40, 10, $row[0], 1, 0, 'C');
    $fpdf->Cell(40, 10, $row[1], 1, 0, 'C');
    // $row[2]
    // Check the value of Remarks and set background color
    $color = '';
    switch ($row[2]) {
        case 'Normal':
            $color = [144, 238, 144]; // Light green
            break;
        case 'Moderate':
            $color = [220, 220, 30]; // Yellow
            break;
        case 'High':
            $color = [255, 99, 71]; // Light red
            break;
        default:
            $color = [255, 255, 255]; // White (default)
            break;
    }
    $fpdf->SetFillColor($color[0], $color[1], $color[2]); // Set background color
    $fpdf->Cell(35, 10, $row[2], 1, 0, 'C', true);
    $fpdf->Cell(40, 10, $row[3], 1, 0, 'C');
    // $row[4]
    // Check the value of Remarks and set background color
    $color = '';
    switch ($row[4]) {
        case 'Normal':
            $color = [144, 238, 144]; // Light green
            break;
        case 'Moderate':
            $color = [220, 220, 30]; // Yellow
            break;
        case 'High':
            $color = [255, 99, 71]; // Light red
            break;
        default:
            $color = [255, 255, 255]; // White (default)
            break;
    }
    $fpdf->SetFillColor($color[0], $color[1], $color[2]); // Set background color
    $fpdf->Cell(35, 10, $row[4], 1, 1, 'C', true);
}

// Second batch table header
$fpdf->Ln(10);
$fpdf->SetFillColor(173, 216, 230); // Light blue color
$fpdf->Cell(35, 10, 'Date of Sampling', 1, 0, 'C', true);
$fpdf->Cell(25, 10, 'CO (ppm)', 1, 0, 'C', true);
$fpdf->Cell(27, 10, 'Remarks', 1, 0, 'C', true);
$fpdf->Cell(25, 10, 'NO2 (ppm)', 1, 0, 'C', true);
$fpdf->Cell(27, 10, 'Remarks', 1, 0, 'C', true);
$fpdf->Cell(25, 10, 'Ozone', 1, 0, 'C', true);
$fpdf->Cell(27, 10, 'Remarks', 1, 1, 'C', true);

// Second batch of data
$secondBatchData = [
    ['2024-03-01', '0.3', 'Normal', '0.5', 'Moderate', '0.5', 'Moderate'],
    ['2024-03-02', '0.4', 'Normal', '0.6', 'Moderate', '0.5', 'Moderate'],
    ['2024-03-03', '0.5', 'Moderate', '0.7', 'High', '0.5', 'Moderate'],
    ['2024-03-03', '0.5', 'Moderate', '0.7', 'High', '0.5', 'Moderate'],
    ['2024-03-03', '0.5', 'High', '0.7', 'High', '0.5', 'Moderate'],
    ['2024-03-03', '0.5', 'High', '0.7', 'High', '0.5', 'Moderate'],
    // Add more data as needed
];
// Populate second batch table with dummy data
foreach ($secondBatchData as $row) {
    $fpdf->Cell(35, 10, $row[0], 1, 0, 'C');
    $fpdf->Cell(25, 10, $row[1], 1, 0, 'C');
    // $row[2]
    // Check the value of Remarks and set background color
    $color = '';
    switch ($row[2]) {
        case 'Normal':
            $color = [144, 238, 144]; // Light green
            break;
        case 'Moderate':
            $color = [220, 220, 30]; // Yellow
            break;
        case 'High':
            $color = [255, 99, 71]; // Light red
            break;
        default:
            $color = [255, 255, 255]; // White (default)
            break;
    }
    $fpdf->SetFillColor($color[0], $color[1], $color[2]); // Set background color
    $fpdf->Cell(27, 10, $row[2], 1, 0, 'C', true);
    $fpdf->Cell(25, 10, $row[3], 1, 0, 'C');
    // $row[4]
    // Check the value of Remarks and set background color
    $color = '';
    switch ($row[4]) {
        case 'Normal':
            $color = [144, 238, 144]; // Light green
            break;
        case 'Moderate':
            $color = [220, 220, 30]; // Yellow
            break;
        case 'High':
            $color = [255, 99, 71]; // Light red
            break;
        default:
            $color = [255, 255, 255]; // White (default)
            break;
    }
    $fpdf->SetFillColor($color[0], $color[1], $color[2]); // Set background color
    $fpdf->Cell(27, 10, $row[4], 1, 0, 'C', true);
    $fpdf->Cell(25, 10, $row[5], 1, 0, 'C');
    // $row[6]
    // Check the value of Remarks and set background color
    $color = '';
    switch ($row[6]) {
        case 'Normal':
            $color = [144, 238, 144]; // Light green
            break;
        case 'Moderate':
            $color = [220, 220, 30]; // Yellow
            break;
        case 'High':
            $color = [255, 99, 71]; // Light red
            break;
        default:
            $color = [255, 255, 255]; // White (default)
            break;
    }
    $fpdf->SetFillColor($color[0], $color[1], $color[2]); // Set background color
    $fpdf->Cell(27, 10, $row[6], 1, 1, 'C', true);
}
        $fpdf->Output();

        

        
        // $fpdf->SetFont('Arial', '', 10);
        // $fpdf->Cell(0, 10, 'Station: ', 0, 0, 'L');      
        // $fpdf->Cell(-91, 10, 'Gaisano Malaybalay City AQMS ', 0, 1, 'R');
        // $fpdf->Ln(0);
        // $fpdf->Cell(0, 0, 'Location: ', 0, 0, 'L');
        // $fpdf->Cell(-80, 0, 'Baragay Something St. Malaybalay City', 0, 1, 'R');
        // $fpdf->Cell(0, 10, 'Area Type: ', 0, 0, 'L');
        // $fpdf->Cell(-116, 10, 'General Ambient', 0, 1, 'R');
        // $fpdf->Cell(0, 0, 'Station Type: ', 0, 0, 'L');
        // $fpdf->Cell(-35, 0, 'Manual PM2.5 Sampler (Mesa Labs BGI PQ200/MetOne EFRM-DC)', 0, 1, 'R');
        // $fpdf->Cell(0, 10, 'Inception Date: ', 0, 0, 'L');
        // $fpdf->Cell(-118, 10, 'March 29, 2024', 0, 1, 'R');
        // $fpdf->Cell(0, 0, 'Monitoring Objectives: ', 0, 0, 'L');
        // $fpdf->Cell(-46, 0, 'To determine the general background concentration of PM2.5', 0, 1, 'R');
        // $fpdf->Cell(0, 10, 'Measures Pollutant: ', 0, 0, 'L');
        // $fpdf->Cell(-95, 10, 'Particulate Matter 2.5 (PM2.5)', 0, 1, 'R');
        // $fpdf->Cell(0, 0, 'Scale Representativeness: ', 0, 0, 'L');
        // $fpdf->Cell(-100, 0, 'Microscale to Middle Scale', 0, 1, 'R');
        // $fpdf->Output();
        exit;
    }
}
