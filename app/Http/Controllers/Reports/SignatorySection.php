<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Reports\PdfReport;
use App\Models\Signatory;

class SignatorySection
{
    public static function SignatoryReport(PdfReport $fpdf)
    {

        // Fetch signatory data
        $signatories = Signatory::all()->keyBy('position'); // Assuming 'position' is unique for each signatory

        // Define a helper function to format signatory names
        $formatSignatoryName = function ($signatory) {
            $profTitle = $signatory->profTitles ? strtoupper($signatory->profTitles) . ' ' : '';
            $middleInitial = $signatory->middleName ? strtoupper($signatory->middleName[0]) . '.' : '';
            return strtoupper($profTitle . $signatory->firstName . ' ' . $middleInitial . ' ' . $signatory->lastName);
        };

        $fpdf->AddPage();
        // Use signatory data for names and positions
        $preparedBy = $signatories->get('Project Document Specialist');
        $reviewedBy = $signatories->get('Senior Environmental Management Specialist');
        $checkedBy = $signatories->get('Chief, Ambient Monitoring and Forcasting Section Services');
        $recommendedBy = $signatories->get('Chief, Environmental Documentation Station Enforcement Division');

        // LastPage
        //NAMES AND SIGNATURE
        $fpdf->ln(15); //margin top (new line)
        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 10, 'Prepared by:', 0, 0, 'L');
        $fpdf->Cell(20, 10, 'Reviewed by:', 0, 1, 'L');
        $fpdf->ln(20);

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(5);
        // $fpdf->Cell(100, 5, 'ENGR. JOHARA JANE G. PECSON', 0, 0, 'L');
        $fpdf->Cell(100, 5, $preparedBy ? $formatSignatoryName($preparedBy) : '', 0, 0, 'L');
        // $fpdf->Cell(0, 5, 'JESSIE JAMES B. OSIN', 0, 1, 'L');
        $fpdf->Cell(0, 5, $reviewedBy ? $formatSignatoryName($reviewedBy) : '', 0, 1, 'L');


        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        // $fpdf->Cell(100, 5, 'Project Document Specialist', 0, 0, 'L');
        $fpdf->Cell(100, 5, $preparedBy ? $preparedBy->position : '', 0, 0, 'L');
        // $fpdf->Cell(0, 5, 'Senior Environmental Management Specialist', 0, 1, 'L');
        $fpdf->Cell(0, 5, $reviewedBy ? $reviewedBy->position : '', 0, 1, 'L');

        $fpdf->ln(5);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 10, 'Checked by:', 0, 0, 'L');
        $fpdf->Cell(0, 10, 'Recommended by:', 0, 1, 'L');
        $fpdf->ln(20);

        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(5);
        // $fpdf->Cell(100, 5, 'ENGR. ROSALINDA L. ILOGON', 0, 0, 'L');
        $fpdf->Cell(100, 5, $checkedBy ? $formatSignatoryName($checkedBy) : '', 0, 0, 'L');
        // $fpdf->Cell(0, 5, 'ENGR. DOVEE CHERRY I. GEOLLEGUE', 0, 1, 'L');
        $fpdf->Cell(0, 5, $recommendedBy ? $formatSignatoryName($recommendedBy) : '', 0, 1, 'L');


        $fpdf->SetFont('Arial', '', 10);
        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'Chief, Ambient Monitoring and Forcasting Section', 0, 0, 'L');
        // $fpdf->Cell(100, 5, $checkedBy ? $checkedBy->position : '', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'Chief, Environmental Documentation Station', 0, 1, 'L');
        // $fpdf->Cell(0, 5, $recommendedBy ? $recommendedBy->position : '', 0, 1, 'L');

        $fpdf->Cell(5);
        $fpdf->Cell(100, 5, 'Services Section', 0, 0, 'L');
        $fpdf->Cell(0, 5, 'Enforcement Division', 0, 1, 'L');
    }
}
