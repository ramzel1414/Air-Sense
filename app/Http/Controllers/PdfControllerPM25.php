<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\CoverPage;
use App\Http\Controllers\Reports\PdfReport;
use App\Http\Controllers\Reports\PM25\PM25Info;
use App\Models\AirQualityData;
use App\Models\Signatory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PdfControllerPM25 extends Controller
{
    public function index()
    {
        // Get daily averages for PM2.5
        $dailyAverages = AirQualityData::select(
            DB::raw('DATE(dateTime) as date'),
            DB::raw('ROUND(AVG(pm25), 2) as pm25_average'),

        )
        ->groupBy('date')
        ->get();

        // Calculate weekly and monthly averages
        $weeklyAverages = $this->calculateAverages('week', $dailyAverages);
        $monthlyAverages = $this->calculateAverages('month', $dailyAverages);

        $minDate = $dailyAverages->min('date');
        $formattedMinDate = Carbon::parse($minDate)->format('F d, Y');

        $fpdf = new PdfReport('P', 'mm', 'A4');
        $fpdf->AddPage();

        // CoverPage ====================================================================================================
        CoverPage::generateCoverPage($fpdf);

        // 2ndPage ====================================================================================================

        PM25Info::PM25Info($fpdf);
        // 3rdPage
        // POLLUTANT TABLE Title
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, 'PM2.5 Pollutant Table', 0, 1, 'C');
        $fpdf->ln(5);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(173, 216, 230);
        $fpdf->Cell(5);
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, 'PM2.5 Concentration in (ug/m^3)', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10);
        $fpdf->Cell(45);
        $fpdf->Cell(20, 10, 'Daily', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Weekly', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'Monthly', 1, 1, 'C', true);
        $fpdf->SetFillColor(111, 241, 117);
        $fpdf->SetFont('Arial', '', 10);

        // Track weeks and months already processed
        $processedWeeks = [];
        $processedMonths = [];

        // Table Body
        foreach ($dailyAverages as $average) {
            $date = $average->date;
            $pm25Average = $average->pm25_average;
            $weekOfYear = Carbon::parse($date)->weekOfYear;
            $month = Carbon::parse($date)->month;

            // Display daily average
            $fpdf->Cell(5);
            $fpdf->Cell(40, 10, $date, 1, 0, 'C');
            $fpdf->Cell(20, 10, number_format($pm25Average, 0), 1, 0, 'C');

            // Display weekly average (once per week)
            if (!in_array($weekOfYear, $processedWeeks)) {
                $weeklyAverageInfo = $this->getWeeklyAverage($weekOfYear, $weeklyAverages);
                $weeklyAverage = $weeklyAverageInfo['average'];
                $daysInWeek = $weeklyAverageInfo['count'];
                $weeklyCellWidth = $daysInWeek * 10; // Adjust width based on number of days

                $fpdf->Cell(20, $weeklyCellWidth, number_format($weeklyAverage, 0), 1, 0, 'C');
                $processedWeeks[] = $weekOfYear;
            } else {
                $fpdf->Cell(20, 10, '', 0, 0, 'C'); // Empty cell for daily rows
            }

            // Display monthly average (once per month)
            if (!in_array($month, $processedMonths)) {
                $monthlyAverageInfo = $this->getMonthlyAverage($month, $monthlyAverages);
                $monthlyAverage = $monthlyAverageInfo['average'];
                $daysInMonth = $monthlyAverageInfo['count'];
                $monthlyCellWidth = $daysInMonth * 10; // Adjust width based on number of days

                $fpdf->Cell(20, $monthlyCellWidth, number_format($monthlyAverage, 0), 1, 0, 'C');
                $processedMonths[] = $month;
            } else {
                $fpdf->Cell(20, 10, '', 0, 0, 'C'); // Empty cell for daily rows
            }

            // Determine classification and color
            $classification = $this->getClassificationPM25($pm25Average);
            $color = $this->getColor($classification);

            // Determine guideline value status
            $guidelineStatus = ($classification !== 'Hazardous' && $classification !== 'Acutely Unhealthy' && $classification !== 'Unhealthy')
                ? 'Within Guideline Value'
                : 'Outside Guideline Value';

            // Common cells for daily rows
            $fpdf->CellFitScale(40, 10, $guidelineStatus, 1, 0, 'C');
            $fpdf->SetFillColor($color[0], $color[1], $color[2]);
            $fpdf->Cell(40, 10, $classification, 1, 1, 'C', true); // Add classification with background color
        }

        // Fetch signatory data
        $signatories = Signatory::all()->keyBy('position'); // Assuming 'position' is unique for each signatory

        // Define a helper function to format signatory names
        $formatSignatoryName = function ($signatory) {
            $profTitle = $signatory->profTitles ? strtoupper($signatory->profTitles) . ' ' : '';
            $middleInitial = $signatory->middleName ? strtoupper($signatory->middleName[0]) . '.' : '';
            return strtoupper($profTitle . $signatory->firstName . ' ' . $middleInitial . ' ' . $signatory->lastName);
        };

        // Use signatory data for names and positions
        $preparedBy = $signatories->get('Project Document Specialist');
        $reviewedBy = $signatories->get('Senior Environmental Management Specialist');
        $checkedBy = $signatories->get('Chief, Ambient Monitoring and Forcasting Section Services');
        $recommendedBy = $signatories->get('Chief, Environmental Documentation Station Enforcement Division');

        // LastPage
        $fpdf->AddPage();
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


        // Output PDF with a unique filename
        $today = date('Y'); // Get current year only (YYYY format)
        $fpdf->Output('I', "AirSense $today Annual CO Assessment.pdf");
        exit;
    }

    // Helper method to calculate weekly and monthly averages
    private function calculateAverages($interval, $dailyAverages)
    {
        $averages = [];
        $counts = []; // Track counts for each interval

        foreach ($dailyAverages as $average) {
            $date = Carbon::parse($average->date);
            $key = $interval === 'week' ? $date->weekOfYear : $date->month;

            if (!isset($averages[$key])) {
                $averages[$key] = [];
                $counts[$key] = 0;
            }

            $averages[$key][] = $average->pm25_average;
            $counts[$key]++;
        }

        // Calculate averages for each interval
        foreach ($averages as $key => $values) {
            $averages[$key] = [
                'average' => array_sum($values) / count($values),
                'count' => $counts[$key]
            ];
        }

        return $averages;
    }

    // Helper method to get weekly average for a given week of year
    private function getWeeklyAverage($weekOfYear, $weeklyAverages)
    {
        return isset($weeklyAverages[$weekOfYear]) ? $weeklyAverages[$weekOfYear] : 0;
    }

    // Helper method to get monthly average for a given month
    private function getMonthlyAverage($month, $monthlyAverages)
    {
        return isset($monthlyAverages[$month]) ? $monthlyAverages[$month] : 0;
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
                return [252, 58, 83];
            case "Acutely Unhealthy":
                return [127, 88, 151];
            case "Hazardous":
                return [128, 0, 0];
            default:
                return [142, 86, 81];
        }
    }
}
