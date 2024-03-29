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
