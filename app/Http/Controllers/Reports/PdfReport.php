<?php

namespace App\Http\Controllers\Reports;

use Codedge\Fpdf\Fpdf\Fpdf;

class PdfReport extends FPDF
{
    function Header()
    {
        //Logo
        $this->Image('airsense.png', 40, 10, 20);
        $this->Image('buksu.png', 150, 10, 20);

        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 12);

        //Parameter for the Cell(): (width(x), height(y), 'text', border, new line, 'alignment')
        $this->Cell(0, 10, 'Republic of the Philippines', 0, 1, 'C');
        $this->Cell(0, 0, 'Malaybalay City, Bukidnon 8700', 0, 1, 'C');
        $this->SetTextColor(0, 0, 255);     //set the color to blue
        $this->Cell(0, 14, '- AirSense -', 0, 1, 'C');
        $this->Cell(0,0, '---------------------------------------------------------------------------------------------------------------------------------------', 0, 0, 'C');
        $this->SetTextColor(0);     //reset the color to black        

    }   

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Print centered page number
        $this->Cell(0, 10, 'Electronic Generated Report. Released on: ' . date('m/d/Y (l) h:i:sa'), 0, 0, 'L');
        $this->Cell(0, 10, 'Page '.$this->PageNo(), 0, 0, 'R');
    }
    
}
