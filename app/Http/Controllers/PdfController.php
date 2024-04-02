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
        

        // Add a table header
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(35, 10, 'Date of Sampling', 1, 0, 'C');
        $fpdf->Cell(60, 10, 'PM 2.5 Concentration (µg/m³)' , 1, 0, 'C'); // Using MultiCell for header
        $fpdf->Cell(30, 10, 'Remarks', 1, 0, 'C');
        $fpdf->Cell(35, 10, 'Air Quality Index', 1, 0, 'C');
        $fpdf->Cell(30, 10, 'Data Capture', 1, 1, 'C');

        // Dummy table data
        $dummyData = [
            ['2024-03-01', '25', 'Normal', '50', 'Automated'],
            ['2024-03-02', '30', 'Normal', '55', 'Automated'],
            ['2024-03-03', '35', 'Moderate', '60', 'Manual'],
            ['2024-03-04', '40', 'Moderate', '65', 'Manual'],
            ['2024-03-05', '45', 'Moderate', '70', 'Manual'],
            ['2024-03-06', '25', 'Normal', '50', 'Automated'],
            ['2024-03-07', '30', 'Normal', '55', 'Automated'],
            ['2024-03-08', '35', 'Moderate', '60', 'Manual'],
            ['2024-03-09', '40', 'Moderate', '65', 'Manual'],
            ['2024-03-10', '45', 'Moderate', '70', 'Manual'],
            ['2024-03-11', '25', 'Normal', '50', 'Automated'],
            ['2024-03-12', '30', 'Normal', '55', 'Automated'],
            ['2024-03-13', '35', 'Moderate', '60', 'Manual'],
            ['2024-03-14', '40', 'Moderate', '65', 'Manual'],
            ['2024-03-15', '45', 'Moderate', '70', 'Manual'],
            ['2024-03-16', '25', 'Normal', '50', 'Automated'],
            ['2024-03-17', '30', 'Normal', '55', 'Automated'],
            ['2024-03-18', '35', 'Moderate', '60', 'Manual'],
            ['2024-03-19', '40', 'Moderate', '65', 'Manual'],
            ['2024-03-20', '45', 'Moderate', '70', 'Manual'],
            ['2024-03-01', '25', 'Normal', '50', 'Automated'],
            ['2024-03-02', '30', 'Normal', '55', 'Automated'],
            ['2024-03-03', '35', 'Moderate', '60', 'Manual'],
            ['2024-03-04', '40', 'Moderate', '65', 'Manual'],
            ['2024-03-05', '45', 'Moderate', '70', 'Manual'],
            ['2024-03-06', '25', 'Normal', '50', 'Automated'],
            ['2024-03-07', '30', 'Normal', '55', 'Automated'],
        ];
        // Add table rows with dummy data
        foreach ($dummyData as $row) {
            $fpdf->Cell(35, 10, $row[0], 1, 0, 'C');
            $fpdf->Cell(60, 10, $row[1], 1, 0, 'C');
            $fpdf->Cell(30, 10, $row[2], 1, 0, 'C');
            $fpdf->Cell(35, 10, $row[3], 1, 0, 'C');
            $fpdf->Cell(30, 10, $row[4], 1, 1, 'C');
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
