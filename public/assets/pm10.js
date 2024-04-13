$(function () {
    'use strict';

    var colors = {
        "Good (Green)": "#00B050",
        "Moderate (Yellow)": "#FFFF00",
        "Unhealthy for Sensitive Groups (Orange)": "#FF6600",
        "Unhealthy (Red)": "#FF0000",
        "Very Unhealthy (Purple)": "#7030A0",
        "Hazardous (Maroon)": "#990033"
    };

    var fontFamily = "'Roboto', Helvetica, sans-serif";

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        var latestData = data.slice(-20);

        var dateTime = latestData.map(function (item) {
            return item.dateTime;
        });
        var pm10 = latestData.map(function (item) {
            return item.pm10; // Changed from pm25 to pm10
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

            series: [
                {
                    name: 'PM10', // Changed from PM2.5 to PM10
                    data: pm10 // Changed from pm25 to pm10
                }
            ],
            xaxis: {
                type: 'date',
                categories: dateTime,
                labels: {
                    style: {
                        colors: 'var(--bs-body-color)',
                    },
                },
            },
            yaxis: {
                title: {
                    text: 'Concentration (µg/m³)',
                    style: {
                        color: 'var(--bs-body-color)',
                    },
                },
                labels: {
                    style: {
                        colors: 'var(--bs-body-color)',
                    },
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

        var chart = new ApexCharts(document.querySelector("#pm10"), options);
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
                }
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
                    var avgPM10Formatted = item.avgPM10.toFixed(1);

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

            var dateTime = date + ' ' + time;

            if (!hourlyAverages[hour]) {
                hourlyAverages[hour] = { dateTime: dateTime, sumPM10: 0, count: 0 };
            }
            hourlyAverages[hour].sumPM10 += item.pm10;
            hourlyAverages[hour].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hour) {
            var avgPM10 = hourlyAverages[hour].sumPM10 / hourlyAverages[hour].count;
            result.push({ dateTime: hourlyAverages[hour].dateTime, avgPM10: avgPM10 });
        });

        return result;
    }

    // Function to determine classification based on PM10 value
    function getClassification(pm10) {
        if (pm10 >= 0 && pm10 <= 54) {
            return "Good (Green)";
        } else if (pm10 > 55 && pm10 <= 154) {
            return "Moderate (Yellow)";
        } else if (pm10 > 155 && pm10 <= 254) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (pm10 > 255 && pm10 <= 354) {
            return "Unhealthy (Red)";
        } else if (pm10 > 355 && pm10 <= 424) {
            return "Very Unhealthy (Purple)";
        } else if (pm10 > 425 && pm10 <= 504) {
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
