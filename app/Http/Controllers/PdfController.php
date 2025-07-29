<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Reports\CoverPage;
use App\Http\Controllers\Reports\PdfReport;
use App\Http\Controllers\Reports\PollutantInfo;
use App\Http\Controllers\Reports\SignatorySection;
use App\Models\AirQualityData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function index()
    {

        // Get daily averages for PM2.5 and PM10
        $dailyAverages = AirQualityData::select(
            DB::raw('DATE(dateTime) as date'),
        )
        ->groupBy('date')
        ->get();

        $pollutants = [
            [
                'name' => 'PM2.5',
                'averageField' => 'pm25',
                'classificationMethod' => 'getClassificationPM25'
            ],
            [
                'name' => 'PM10',
                'averageField' => 'pm10',
                'classificationMethod' => 'getClassificationPM10'
            ],
            [
                'name' => 'CO',
                'averageField' => 'co',
                'classificationMethod' => 'getClassificationCO'
            ],
            [
                'name' => 'NO2',
                'averageField' => 'no2',
                'classificationMethod' => 'getClassificationNO2'
            ],
            [
                'name' => 'O3',
                'averageField' => 'ozone',
                'classificationMethod' => 'getClassificationOzone'
            ],
        ];

        $minDate = $dailyAverages->min('date');
        $formattedMinDate = Carbon::parse($minDate)->format('F d, Y');

        // Initialize PDF report
        $fpdf = new PdfReport('P', 'mm', 'A4');
        $fpdf->AddPage();

        // CoverPage ====================================================================================================
        CoverPage::generateCoverPage($fpdf);
        $first = true;


        // 2ndPage ====================================================================================================

        PollutantInfo::PollutantInfo($fpdf);

        // 3rdPage ====================================================================================================

        foreach ($pollutants as $pollutant) {
            if (!$first) {
                $fpdf->AddPage(); // Add a new page before generating the report for subsequent pollutants
            } else {
                $first = false;
            }
            $this->generatePollutantReport($fpdf, $pollutant);
        }

        SignatorySection::SignatoryReport($fpdf);

        // Output PDF with a unique filename
        $today = date('Y'); // Get current year only (YYYY format)
        $fpdf->Output('I', "AirSense $today Annual Assessment.pdf");
        exit;
    }

    private function generatePollutantReport($fpdf, $pollutant)
    {

        $completeNames = [
            'PM2.5' => 'Particulate Matter 2.5',
            'PM10' => 'Particulate Matter 10',
            'CO' => 'Carbon Monoxide',
            'NO2' => 'Nitrogen Dioxide',
            'O3' => 'Ground-level Ozone'
        ];

        $concentrationUnits = [
            'PM2.5' => '(ug/m3)',
            'PM10' => '(ug/m3)',
            'CO' => '(ppm)',
            'NO2' => '(ppm)',
            'O3' => '(ppm)'
        ];
        $completeName = $completeNames[$pollutant['name']] ?? 'Unknown Pollutant';
        $units = $concentrationUnits[$pollutant['name']] ?? '';


        // Get daily averages for the current pollutant
        $dailyAverages = AirQualityData::select(
            DB::raw('DATE(dateTime) as date'),
            DB::raw('ROUND(AVG(' . $pollutant['averageField'] . '), 2) as average')
        )
        ->groupBy('date')
        ->get();

        // Calculate weekly and monthly averages
        $weeklyAverages = $this->calculateAverages('week', $dailyAverages);
        $monthlyAverages = $this->calculateAverages('month', $dailyAverages);

        // POLLUTANT TABLE Title
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->ln(5);
        $fpdf->Cell(0, 5, '', 0, 1, 'C');
        $fpdf->Cell(0, 10, $completeName . ' Pollutant Report', 0, 1, 'C');
        $fpdf->ln(3);

        // Table Header
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(244, 255, 255);
        $fpdf->Cell(5);
        $fpdf->Cell(40, 20, 'Date of Sampling', 1, 0, 'C', true);
        $fpdf->Cell(60, 10, $pollutant['name'] . ' Concentration in ' . $units, 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Remarks', 1, 0, 'C', true);
        $fpdf->Cell(40, 20, 'Classification', 1, 0, 'C', true);
        $fpdf->Ln(10);
        $fpdf->Cell(45);
        $fpdf->SetFont('Arial', 'B', 9);
        $fpdf->CellFitScale(20, 10, 'Daily (Avg)', 1, 0, 'C', true);
        $fpdf->CellFitScale(20, 10, 'Weekly (Avg)', 1, 0, 'C', true);
        $fpdf->CellFitScale(20, 10, 'Monthly (Avg)', 1, 1, 'C', true);
        $fpdf->SetFillColor(111, 241, 117);
        $fpdf->SetFont('Arial', '', 10);

        // Track processed weeks and months
        $processedWeeks = [];
        $processedMonths = [];

        // Table Body
        foreach ($dailyAverages as $average) {
            $date = $average->date;
            $pollutantAverage = $average->average;
            $weekOfYear = Carbon::parse($date)->weekOfYear;
            $month = Carbon::parse($date)->month;

            // Display daily average
            $fpdf->Cell(5);
            $fpdf->Cell(40, 10, $date, 1, 0, 'C');
            $fpdf->Cell(20, 10, $this->formatPollutantValue($pollutantAverage, $pollutant['name']), 1, 0, 'C');

            // Display weekly average (once per week)
            if (!in_array($weekOfYear, $processedWeeks)) {
                $weeklyAverageInfo = $this->getIntervalAverage($weekOfYear, $weeklyAverages);
                $weeklyAverage = $weeklyAverageInfo['average'];
                $daysInWeek = $weeklyAverageInfo['count'];
                $weeklyCellWidth = $daysInWeek * 10; // Adjust width based on number of days

                $fpdf->Cell(20, $weeklyCellWidth, $this->formatPollutantValue($weeklyAverage, $pollutant['name']), 1, 0, 'C');
                $processedWeeks[] = $weekOfYear;
            } else {
                $fpdf->Cell(20, 10, '', 0, 0, 'C'); // Empty cell for daily rows
            }

            // Display monthly average (once per month)
            if (!in_array($month, $processedMonths)) {
                $monthlyAverageInfo = $this->getIntervalAverage($month, $monthlyAverages);
                $monthlyAverage = $monthlyAverageInfo['average'];
                $daysInMonth = $monthlyAverageInfo['count'];
                $monthlyCellWidth = $daysInMonth * 10; // Adjust width based on number of days

                $fpdf->Cell(20, $monthlyCellWidth, $this->formatPollutantValue($monthlyAverage, $pollutant['name']), 1, 0, 'C');
                $processedMonths[] = $month;
            } else {
                $fpdf->Cell(20, 10, '', 0, 0, 'C'); // Empty cell for daily rows
            }

            // Determine classification and color
            $classificationMethod = $pollutant['classificationMethod'];
            $classification = $this->$classificationMethod($pollutantAverage);
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
    }

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

            $averages[$key][] = $average->average;
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

    private function getIntervalAverage($intervalKey, $intervalAverages)
    {
        return isset($intervalAverages[$intervalKey]) ? $intervalAverages[$intervalKey] : ['average' => 0, 'count' => 0];
    }

    // Function to format pollutant value based on its name
    private function formatPollutantValue($value, $pollutantName)
    {
        switch ($pollutantName) {
            case 'PM2.5':
            case 'PM10':
            case 'CO':
                return number_format($value, 0); // 0 decimal places
            case 'NO2':
                return number_format($value, 2); // 2 decimal places
            case 'O3':
                return number_format($value, 3); // 3 decimal places
            default:
                return number_format($value, 2); // Default format (adjust as needed)
        }
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



















