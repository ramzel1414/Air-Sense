$(function () {
    'use strict';

    const colorRanges = [
        { value: 0, color: '#800000' },  // Maroon for 0-25
        { value: 25, color: '#9b1d20' }, // Purple for 25.1-35
        { value: 35, color: '#ef4444' }, // Red for 35.1-45
        { value: 45, color: '#fb923c' }, // Orange for 45.1-55
        { value: 55, color: '#ffce63' }, // Yellow for 55.1-90
        { value: 90, color: '#22c55f' }  // Green for values above 90
    ];

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        const latestData = data.slice(-20);

        const dateTime = latestData.map((item) => item.dateTime);
        const pm10 = latestData.map((item) => item.pm10);

        // Calculate the color stops based on fixed PM10 value ranges
        const colorStops = colorRanges.map((range, index) => {
            // Map the color value based on the fixed PM10 thresholds
            const offset = (index / (colorRanges.length - 1)) * 100; // Ensure last offset is exactly 100%
            return {
                offset: offset,
                color: range.color,
                opacity: 1
            };
        });
    }

    // Function to render the chart
    function renderChart(data) {
        // Retrieve only the latest 20 data points
        const latestData = data.slice(-20);

        const dateTime = latestData.map((item) => item.dateTime);
        const pm10 = latestData.map((item) => item.pm10);

        // Calculate the color stops based on fixed PM10 value ranges
        const colorStops = colorRanges.map((range, index) => {
            // Map the color value based on the fixed PM10 thresholds
            const offset = (index / (colorRanges.length - 1)) * 100; // Ensure last offset is exactly 100%
            return {
                offset: offset,
                color: range.color,
                opacity: 1
            };
        });

        // ApexCharts configuration
        const options = {
            chart: {
                type: "line",
                height: 400,
                animations: {
                    enabled: true,
                    easing: "linear",
                    dynamicAnimation: { speed: 500 }
                },
                toolbar: {
                    show: false,
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    opacityFrom: 1,
                    opacityTo: 1,
                    colorStops: colorStops
                }
            },
            series: [
                {
                    name: "PM10",
                    data: pm10
                }
            ],
            xaxis: {
                type: "date",
                categories: dateTime,
                labels: {
                    style: {
                        colors: "var(--bs-body-color)"
                    }
                }
            },
            yaxis: {
                title: {
                    text: "Concentration (µg/m³)",
                    style: {
                        color: "var(--bs-body-color)"
                    }
                },
                labels: {
                    style: {
                        colors: "var(--bs-body-color)"
                    }
                }
            },
            stroke: {
                width: 2,
                curve: "smooth"
            },
            markers: {
                size: 4
            },
            tooltip: {
                x: { show: false },
                marker: { show: false }
            }
        };

        // Render the chart
        const chart = new ApexCharts(document.querySelector("#pm10"), options);
        chart.render();

        var intervalId;

        // Add event listeners to pause and resume chart update interval
        document.querySelector("#pm10").addEventListener('mouseenter', function () {
            clearInterval(intervalId);
        });

        document.querySelector("#pm10").addEventListener('mouseleave', function () {
            intervalId = setInterval(updateChart, 1000);
        });

        function updateChart() {
            $.ajax({
                url: '/pm10-data',
                method: 'GET',
                success: function (data) {
                    var newDateTime = data.map(function (item) {
                        return item.dateTime;
                    });
                    var newPm10 = data.map(function (item) {
                        return item.pm10;
                    });

                    // Update chart with only the latest 15 data points
                    var latestData = data.slice(-15);
                    chart.updateOptions({
                        xaxis: {
                            categories: newDateTime.slice(-15)
                        }
                    });

                    chart.updateSeries([{
                        data: newPm10.slice(-15)
                    }]);
                },
                error: function (error) {
                    console.log('Error fetching data:', error);
                },
            });
        }
        // Update chart every second
        intervalId = setInterval(updateChart, 1000);
    }

    // Fetch initial data and render the chart
    $.ajax({
        url: '/pm10-data',
        method: 'GET',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.log('Error fetching initial data:', error);
        }
    });

    // Attach click event listener to the button for exporting PM10 data
    $('#expPM10').on('click', function () {
        $('#processing-pm10').show();
        $('#download-csv-pm10').hide();

        $.ajax({
            url: '/pm10-data',
            method: 'GET',
            success: function (data) {
                // Calculate average PM10 values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "Timestamp,PM10,Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM10);
                    var healthImpact = getHealthImpact(classification);

                    // Format average PM10 value to one decimal place
                    var avgPM10Formatted = item.avgPM10.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM10Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm10-average-per-hour.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm10').hide();
                $('#download-csv-pm10').show();
            }
        });
    });

    // Function to calculate average PM10 values by hour
    function calculateAverageByHour(data) {
        var hourlyAverages = {};
        data.forEach(function (item) {
            var dateTimeParts = item.dateTime.split(' ');
            var date = dateTimeParts[0];
            var time = dateTimeParts[1];
            var hour = time.split(':')[0];

            var hourDateTime = date + ' ' + hour + ':00:00';
            if (!hourlyAverages[hourDateTime]) {
                hourlyAverages[hourDateTime] = { sumPM10: 0, count: 0 };
            }
            hourlyAverages[hourDateTime].sumPM10 += item.pm10;
            hourlyAverages[hourDateTime].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hourDateTime) {
            var avgPM10 = hourlyAverages[hourDateTime].sumPM10 / hourlyAverages[hourDateTime].count;
            result.push({ dateTime: hourDateTime, avgPM10: avgPM10 });
        });
        return result;
    }

    // DAILY
    $('#expPM10Daily').on('click', function () {
        $('#processing-pm10').show();
        $('#download-csv-pm10').hide();

        $.ajax({
            url: '/pm10-data',
            method: 'GET',
            success: function (data) {
                // Calculate daily average PM10 values
                var dailyAverageData = calculateAverageByDay(data);

                // Sort dailyAverageData array by dateTime (ascending order)
                dailyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Date,PM10,Classification,Health Impact\n";
                dailyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM10);
                    var healthImpact = getHealthImpact(classification);
                    var avgPM10Formatted = item.avgPM10.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM10Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm10-average-per-day.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm10').hide();
                $('#download-csv-pm10').show();
            }
        });
    });

    function calculateAverageByDay(data) {
        var dailyAverages = {};

        data.forEach(function (item) {
            var date = item.dateTime.split(' ')[0];

            if (!dailyAverages[date]) {
                dailyAverages[date] = { sumPM10: 0, count: 0 };
            }

            dailyAverages[date].sumPM10 += item.pm10;
            dailyAverages[date].count++;
        });

        var result = [];
        Object.keys(dailyAverages).forEach(function (date) {
            var avgPM10 = dailyAverages[date].sumPM10 / dailyAverages[date].count;
            result.push({ dateTime: date, avgPM10: avgPM10 });
        });

        return result;
    }

    // MONTHLY
    $('#expPM10Monthly').on('click', function () {
        $('#processing-pm10').show();
        $('#download-csv-pm10').hide();

        $.ajax({
            url: '/pm10-data',
            method: 'GET',
            success: function (data) {
                // Calculate monthly average PM10 values
                var monthlyAverageData = calculateAverageByMonth(data);

                // Sort monthlyAverageData array by dateTime (ascending order)
                monthlyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Month,PM10,Classification,Health Impact\n";
                monthlyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM10);
                    var healthImpact = getHealthImpact(classification);
                    var avgPM10Formatted = item.avgPM10.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM10Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm10-average-per-month.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm10').hide();
                $('#download-csv-pm10').show();
            }
        });
    });

    function calculateAverageByMonth(data) {
        var monthlyAverages = {};

        data.forEach(function (item) {
            var date = new Date(item.dateTime);
            var monthYearKey = date.getFullYear() + '-' + (date.getMonth() + 1);

            if (!monthlyAverages[monthYearKey]) {
                monthlyAverages[monthYearKey] = { sumPM10: 0, count: 0 };
            }

            monthlyAverages[monthYearKey].sumPM10 += item.pm10;
            monthlyAverages[monthYearKey].count++;
        });

        var result = [];
        Object.keys(monthlyAverages).forEach(function (monthYearKey) {
            var avgPM10 = monthlyAverages[monthYearKey].sumPM10 / monthlyAverages[monthYearKey].count;
            var [year, month] = monthYearKey.split('-');
            var monthYear = `${year}-${month}`;

            result.push({ dateTime: monthYear, avgPM10: avgPM10 });
        });

        return result;
    }

    // Function to determine classification based on PM10 value
    function getClassification(pm10) {
        if (pm10 >= 0 && pm10 <= 54) {
            return "Good (Green)";
        } else if (pm10 > 55 && pm10 <= 154) {
            return "Moderate (Yellow)";
        } else if (pm10 > 154 && pm10 <= 254) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (pm10 > 254 && pm10 <= 354) {
            return "Unhealthy (Red)";
        } else if (pm10 > 354 && pm10 <= 424) {
            return "Very Unhealthy (Purple)";
        } else if (pm10 > 424 && pm10 <= 504) {
            return "Hazardous (Maroon)";
        } else {
            return "Unknown Classification";
        }
    }

    // Function to determine health impact based on classification
    function getHealthImpact(classification) {
        switch (classification) {
            case "Good (Green)":
                return "Low risk";
            case "Moderate (Yellow)":
                return "Low to moderate risk";
            case "Unhealthy for Sensitive Groups (Orange)":
                return "Moderate risk for sensitive groups like children, elderly, and those with lung/heart problems";
            case "Unhealthy (Red)":
                return "Considerable risk for everyone";
            case "Very Unhealthy (Purple)":
                return "High risk for everyone";
            case "Hazardous (Maroon)":
                return "Very high risk for everyone";
            default:
                return "Unknown Classification";
        }
    }
});
