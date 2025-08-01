$(function () {
    'use strict';

    // Define the color ranges based on the PM2.5 values
    const colorRanges = [
        { value: 0, color: '#800000' },  // Green for 0-25
        { value: 25, color: '#9b1d20' }, // Yellow for 25.1-35
        { value: 35, color: '#ef4444' }, // Orange for 35.1-45
        { value: 45, color: '#fb923c' }, // Red for 45.1-55
        { value: 55, color: '#ffce63' }, // Purple for 55.1-90
        { value: 90, color: '#22c55f' },  // Maroon for values above 90
        { value: 100, color: '#22c55f' }  // Maroon for values above 90

    ];

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        var latestData = data.slice(-20);

        var dateTime = latestData.map(function (item) {
            return item.dateTime;
        });
        var pm25 = latestData.map(function (item) {
            return item.pm25;
        });

        // Calculate the color stops based on fixed value ranges
        const colorStops = colorRanges.map((range, index) => {
            // Map the color value based on the fixed PM2.5 thresholds
            const offset = (index / (colorRanges.length - 1)) * 100; // Calculate the offset for each range
            return {
                offset: offset,
                color: range.color,
                opacity: 1
            };
        });

        var options = {
            chart: {
                type: "line",
                height: 400,
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 500
                    }
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
                    },
                },
            },

            fill: {
                type: "gradient",
                gradient: {
                    type: 'vertical',
                    shadeIntensity: 1,
                    opacityFrom: 1,
                    opacityTo: 1,
                    colorStops: colorStops
                }
            },

            series: [
                {
                    name: 'PM2.5',
                    data: pm25
                }
            ],
            xaxis: {
                type: 'date',
                categories: dateTime,
            },
            yaxis: {
                title: {
                    text: 'Concentration (µg/m³)',
                },
            },
            stroke: {
                width: 2,
                curve: "smooth"
            },
            markers: {
                size: 4,
            },


            tooltip: {
                x: {
                    show: false,
                },
                marker: {
                    show: false,
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#pm25"), options);
        chart.render();

        var intervalId;

        // Add event listeners to pause and resume chart update interval
        document.querySelector("#pm25").addEventListener('mouseenter', function () {
            clearInterval(intervalId);
        });

        document.querySelector("#pm25").addEventListener('mouseleave', function () {
            intervalId = setInterval(updateChart, 1000);
        });

        function updateChart() {
            $.ajax({
                url: '/pm25-data',
                method: 'GET',
                success: function (data) {
                    var newDateTime = data.map(function (item) {
                        return item.dateTime;
                    });
                    var newPm25 = data.map(function (item) {
                        return item.pm25;
                    });

                    // Update chart with only the latest 15 data points
                    var latestData = data.slice(-15);
                    chart.updateOptions({
                        xaxis: {
                            categories: newDateTime.slice(-15)
                        }
                    });

                    chart.updateSeries([{
                        data: newPm25.slice(-15)
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
        url: '/pm25-data',
        method: 'GET',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.log('Error fetching initial data:', error);
        }
    });

    // Attach click event listener to the button for exporting PM2.5 data
    $('#expPM25').on('click', function () {
        $('#processing-pm25').show();
        $('#download-csv-pm25').hide();

        $.ajax({
            url: '/pm25-data',
            method: 'GET',
            success: function (data) {
                // Calculate average PM2.5 values by hour
                var averageData = calculateAverageByHour(data);

                // Sort averageData array by dateTime (ascending order)
                averageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Timestamp,PM2.5,Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM25);
                    var healthImpact = getHealthImpact(classification);

                    // Format average PM2.5 value to one decimal place
                    var avgPM25Formatted = item.avgPM25.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM25Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm25-average-per-hour.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm25').hide();
                $('#download-csv-pm25').show();
            }
        });
    });

    // Function to calculate average PM2.5 values by hour
    function calculateAverageByHour(data) {
        var hourlyAverages = {};
        data.forEach(function (item) {
            var dateTimeParts = item.dateTime.split(' ');
            var date = dateTimeParts[0];
            var time = dateTimeParts[1];
            var hour = time.split(':')[0];

            var hourDateTime = date + ' ' + hour + ':00:00';
            if (!hourlyAverages[hourDateTime]) {
                hourlyAverages[hourDateTime] = { sumPM25: 0, count: 0 };
            }
            hourlyAverages[hourDateTime].sumPM25 += item.pm25;
            hourlyAverages[hourDateTime].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hourDateTime) {
            var avgPM25 = hourlyAverages[hourDateTime].sumPM25 / hourlyAverages[hourDateTime].count;
            result.push({ dateTime: hourDateTime, avgPM25: avgPM25 });
        });
        return result;
    }

    // DAILY
    $('#expPM25Daily').on('click', function () {
        $('#processing-pm25').show();
        $('#download-csv-pm25').hide();

        $.ajax({
            url: '/pm25-data',
            method: 'GET',
            success: function (data) {
                // Calculate daily average PM2.5 values
                var dailyAverageData = calculateAverageByDay(data);

                // Sort dailyAverageData array by dateTime (ascending order)
                dailyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Date,PM2.5,Classification,Health Impact\n";
                dailyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM25);
                    var healthImpact = getHealthImpact(classification);
                    var avgPM25Formatted = item.avgPM25.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM25Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm25-average-per-day.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm25').hide();
                $('#download-csv-pm25').show();
            }
        });
    });

    function calculateAverageByDay(data) {
        var dailyAverages = {};

        data.forEach(function (item) {
            var date = item.dateTime.split(' ')[0];

            if (!dailyAverages[date]) {
                dailyAverages[date] = { sumPM25: 0, count: 0 };
            }

            dailyAverages[date].sumPM25 += item.pm25;
            dailyAverages[date].count++;
        });

        var result = [];
        Object.keys(dailyAverages).forEach(function (date) {
            var avgPM25 = dailyAverages[date].sumPM25 / dailyAverages[date].count;
            result.push({ dateTime: date, avgPM25: avgPM25 });
        });

        return result;
    }

    // MONTHLY
    $('#expPM25Monthly').on('click', function () {
        $('#processing-pm25').show();
        $('#download-csv-pm25').hide();

        $.ajax({
            url: '/pm25-data',
            method: 'GET',
            success: function (data) {
                // Calculate monthly average PM2.5 values
                var monthlyAverageData = calculateAverageByMonth(data);

                // Sort monthlyAverageData array by dateTime (ascending order)
                monthlyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Month,PM2.5,Classification,Health Impact\n";
                monthlyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM25);
                    var healthImpact = getHealthImpact(classification);
                    var avgPM25Formatted = item.avgPM25.toFixed(0);

                    csvContent += item.dateTime + "," + avgPM25Formatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'pm25-average-per-month.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-pm25').hide();
                $('#download-csv-pm25').show();
            }
        });
    });

    function calculateAverageByMonth(data) {
        var monthlyAverages = {};

        data.forEach(function (item) {
            var date = new Date(item.dateTime);
            var monthYearKey = date.getFullYear() + '-' + (date.getMonth() + 1);

            if (!monthlyAverages[monthYearKey]) {
                monthlyAverages[monthYearKey] = { sumPM25: 0, count: 0 };
            }

            monthlyAverages[monthYearKey].sumPM25 += item.pm25;
            monthlyAverages[monthYearKey].count++;
        });

        var result = [];
        Object.keys(monthlyAverages).forEach(function (monthYearKey) {
            var avgPM25 = monthlyAverages[monthYearKey].sumPM25 / monthlyAverages[monthYearKey].count;
            var [year, month] = monthYearKey.split('-');
            var monthYear = `${year}-${month}`;

            result.push({ dateTime: monthYear, avgPM25: avgPM25 });
        });

        return result;
    }

    // Function to determine classification based on PM2.5 value
    function getClassification(pm25) {
        if (pm25 >= 0 && pm25 <= 25) {
            return "Good (Green)";
        } else if (pm25 > 25 && pm25 <= 35) {
            return "Moderate (Yellow)";
        } else if (pm25 > 35 && pm25 <= 45) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (pm25 > 45 && pm25 <= 55) {
            return "Unhealthy (Red)";
        } else if (pm25 > 55 && pm25 <= 90) {
            return "Very Unhealthy (Purple)";
        } else if (pm25 > 90) {
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
