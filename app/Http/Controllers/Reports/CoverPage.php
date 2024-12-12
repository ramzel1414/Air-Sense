<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Reports\PdfReport;

class CoverPage
{
    public static function generateCoverPage(PdfReport $fpdf)
    {
        $fpdf->Image('airsense-prot2.png', 5, 50, 200);
        $fpdf->SetFillColor(255, 255, 255, 127); // White background color
        $fpdf->Rect(40, 210, 130, 50, 'F'); // x, y, w, h, 'F' indicates to fill the rectangle

        $today = date('Y');
        $description = "CY $today\nOVERALL ASSESSMENT REPORT OF BUKIDNON STATE UNIVERSITY- (MAIN CAMPUS)\nIoT AIR QUALITY MONITORING STATION\n(PM2.5, PM10, CO, NO2, AND O3)";
        $fpdf->SetFont('Arial', '', 13);
        $fpdf->SetXY(40 + 5, 210 + 5); // Adjust the position for the description
        $fpdf->MultiCell(130 - 10, 8, $description, 0, 'C');
        $fpdf->AddPage();
    }
}
