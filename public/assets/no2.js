$(function () {
    'use strict';

    // Define the color ranges based on the PM2.5 values
    const colorRanges = [
        { value: 50, color: '#ef4444' },
        { value: 20, color: '#fb923c' },
        { value: 15, color: '#ffce63' },
        { value: 10, color: '#22c55f' },
        { value: 1, color: '#22c55f' } // End with green

    ];

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        const latestData = data.slice(-20);

        const dateTime = latestData.map((item) => item.dateTime);
        const no2 = latestData.map((item) => item.no2);

        // Calculate the color stops based on NO2 thresholds
        const colorStops = colorRanges.map((range, index) => {
            // Ensure offsets are distributed evenly across thresholds
            const offset = (index / (colorRanges.length - 1)) * 100;
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
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false,
                        customIcons: []
                    }
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
                    name: "NO₂",
                    data: no2
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
                    text: "Concentration (ppm)",
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
        const chart = new ApexCharts(document.querySelector("#no2"), options);
        chart.render();

        var intervalId;

        // Add event listeners to pause and resume chart update interval
        document.querySelector("#no2").addEventListener('mouseenter', function () {
            clearInterval(intervalId);
        });

        document.querySelector("#no2").addEventListener('mouseleave', function () {
            intervalId = setInterval(updateChart, 1000);
        });

        function updateChart() {
            $.ajax({
                url: '/no2-data',
                method: 'GET',
                success: function (data) {
                    var newDateTime = data.map(function (item) {
                        return item.dateTime;
                    });
                    var newNo2 = data.map(function (item) {
                        return item.no2;
                    });

                    // Update chart with only the latest 15 data points
                    var latestData = data.slice(-15);
                    chart.updateOptions({
                        xaxis: {
                            categories: newDateTime.slice(-15)
                        }
                    });

                    chart.updateSeries([{
                        data: newNo2.slice(-15)
                    }]);
                },
                error: function (error) {
                    console.log('Error fetching data:', error);
                }
            });
        }

        // Update chart every second
        intervalId = setInterval(updateChart, 1000);
    }

    // Fetch initial data and render the chart
    $.ajax({
        url: '/no2-data',
        method: 'GET',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.log('Error fetching initial data:', error);
        }
    });


    // Attach click event listener to export NO2 data
    $('#expNO2').on('click', function () {
        $('#processing-no2').show();
        $('#download-csv-no2').hide();
        $.ajax({
            url: '/no2-data',
            method: 'GET',
            success: function (data) {
                // Calculate average NO2 values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "DateTime,NO2 (ppm),Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgNO2);
                    var healthImpact = getHealthImpact(classification);

                    var avgNO2Formatted = item.avgNO2.toFixed(2);

                    csvContent += item.dateTime + "," + avgNO2Formatted + "," + classification + "," + healthImpact + "\n";

                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'no2-average-per-hour.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching NO2 data:', error);
            },
            complete: function () {
                $('#processing-no2').hide();
                $('#download-csv-no2').show();
            }
        });
    });

    // Function to calculate average NO2 values by hour
    function calculateAverageByHour(data) {
        var hourlyAverages = {};
        data.forEach(function (item) {
            var dateTimeParts = item.dateTime.split(' ');
            var date = dateTimeParts[0];
            var time = dateTimeParts[1];
            var hour = time.split(':')[0];

            var hourDateTime = date + ' ' + hour + ':00:00';
            if (!hourlyAverages[hourDateTime]) {
                hourlyAverages[hourDateTime] = { sumNO2: 0, count: 0 };
            }
            hourlyAverages[hourDateTime].sumNO2 += item.no2;
            hourlyAverages[hourDateTime].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hourDateTime) {
            var avgNO2 = hourlyAverages[hourDateTime].sumNO2 / hourlyAverages[hourDateTime].count;
            result.push({ dateTime: hourDateTime, avgNO2: avgNO2 });
        });
        return result;
    }


    // DAILY
    $('#expNO2Daily').on('click', function () {
        $('#processing-no2').show();
        $('#download-csv-no2').hide();
        $.ajax({
            url: '/no2-data',
            method: 'GET',
            success: function (data) {
                // Calculate daily average NO2 values
                var dailyAverageData = calculateAverageByDay(data);

                // Sort dailyAverageData array by dateTime (ascending order)
                dailyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Date,NO2,Classification,Health Impact\n";
                dailyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgNO2);
                    var healthImpact = getHealthImpact(classification);
                    var avgNO2Formatted = item.avgNO2.toFixed(2);

                    csvContent += item.dateTime + "," + avgNO2Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'no2-average-per-day.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-no2').hide();
                $('#download-csv-no2').show();
            }
        });
    });

    function calculateAverageByDay(data) {
        var dailyAverages = {};

        data.forEach(function (item) {
            var date = item.dateTime.split(' ')[0];

            if (!dailyAverages[date]) {
                dailyAverages[date] = { sumNO2: 0, count: 0 };
            }

            dailyAverages[date].sumNO2 += item.no2;
            dailyAverages[date].count++;
        });

        var result = [];
        Object.keys(dailyAverages).forEach(function (date) {
            var avgNO2 = dailyAverages[date].sumNO2 / dailyAverages[date].count;
            result.push({ dateTime: date, avgNO2: avgNO2 });
        });

        return result;
    }


    // MONTHLY
    $('#expNO2Monthly').on('click', function () {
        $('#processing-no2').show();
        $('#download-csv-no2').hide();
        $.ajax({
            url: '/no2-data',
            method: 'GET',
            success: function (data) {
                // Calculate monthly average NO2 values
                var monthlyAverageData = calculateAverageByMonth(data);

                // Sort monthlyAverageData array by dateTime (ascending order)
                monthlyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Month,NO2,Classification,Health Impact\n";
                monthlyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgNO2);
                    var healthImpact = getHealthImpact(classification);
                    var avgNO2Formatted = item.avgNO2.toFixed(2);

                    csvContent += item.dateTime + "," + avgNO2Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'no2-average-per-month.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-no2').hide();
                $('#download-csv-no2').show();
            }
        });
    });

    function calculateAverageByMonth(data) {
        var monthlyAverages = {};

        data.forEach(function (item) {
            var date = new Date(item.dateTime);
            var monthYearKey = date.getFullYear() + '-' + (date.getMonth() + 1);

            if (!monthlyAverages[monthYearKey]) {
                monthlyAverages[monthYearKey] = { sumNO2: 0, count: 0 };
            }

            monthlyAverages[monthYearKey].sumNO2 += item.no2;
            monthlyAverages[monthYearKey].count++;
        });

        var result = [];
        Object.keys(monthlyAverages).forEach(function (monthYearKey) {
            var avgNO2 = monthlyAverages[monthYearKey].sumNO2 / monthlyAverages[monthYearKey].count;
            var [year, month] = monthYearKey.split('-');
            var monthYear = `${year}-${month}`;

            result.push({ dateTime: monthYear, avgNO2: avgNO2 });
        });

        return result;
    }

    // Function to determine classification based on PM10 value
    function getClassification(no2) {
        if (no2 >= 0 && no2 <= 0.05 + Number.EPSILON) {
            return "Good (Green)";
        } else if (no2 > 0.05 + Number.EPSILON && no2 <= 0.10 + Number.EPSILON) {
            return "Moderate (Yellow)";
        } else if (no2 > 0.10 + Number.EPSILON && no2 <= 0.36 + Number.EPSILON) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (no2 > 0.36 + Number.EPSILON && no2 <= 0.65 + Number.EPSILON) {
            return "Unhealthy (Red)";
        } else if (no2 > 0.65 + Number.EPSILON && no2 <= 1.24 + Number.EPSILON) {
            return "Very Unhealthy (Purple)";
        } else if (no2 > 1.24 + Number.EPSILON) {
            return "Hazardous (Maroon)";
        } else {
            return "Unknown classification";
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
                return "Unknown classification";
        }
    }
});
