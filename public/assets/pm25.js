$(function () {
    'use strict';

    var colors = {
        primary: "#6571ff",
        secondary: "#7987a1",
        success: "#05a34a",
        info: "#66d1d1",
        warning: "#fbbc06",
        danger: "#ff3366",
        light: "#e9ecef",
        dark: "#060c17",
        muted: "#7987a1",
        gridBorder: "rgba(77, 138, 240, .15)",
        bodyColor: "#000",
        cardBg: "#fff"
    };

    var fontFamily = "'Roboto', Helvetica, sans-serif";

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        var latestData = data.slice(-20);

        var dateTime = latestData.map(function (item) {
            return item.dateTime;
        });
        var pm25 = latestData.map(function (item) {
            return item.pm25;
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
                    name: 'PM2.5',
                    data: pm25
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
                size: 4
            },
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
        $.ajax({
            url: '/pm25-data',
            method: 'GET',
            success: function (data) {
                // Calculate average PM2.5 values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "DateTime,PM2.5 (ug/m3),Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgPM25);
                    var healthImpact = getHealthImpact(classification);

                    // Format average PM2.5 value to one decimal place
                    var avgPM25Formatted = item.avgPM25.toFixed(1);

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

            var dateTime = date + ' ' + time;

            if (!hourlyAverages[hour]) {
                hourlyAverages[hour] = { dateTime: dateTime, sumPM25: 0, count: 0 };
            }
            hourlyAverages[hour].sumPM25 += item.pm25;
            hourlyAverages[hour].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hour) {
            var avgPM25 = hourlyAverages[hour].sumPM25 / hourlyAverages[hour].count;
            result.push({ dateTime: hourlyAverages[hour].dateTime, avgPM25: avgPM25 });
        });

        return result;
    }

    // Function to determine classification based on PM2.5 value
    function getClassification(pm25) {
        if (pm25 >= 0 && pm25 <= 25) {
            return "Good (Green)";
        } else if (pm25 > 25.1 && pm25 <= 35) {
            return "Moderate (Yellow)";
        } else if (pm25 > 35.1 && pm25 <= 45) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (pm25 > 45.1 && pm25 <= 55) {
            return "Unhealthy (Red)";
        } else if (pm25 > 55.1 && pm25 <= 90) {
            return "Very Unhealthy (Purple)";
        } else if (pm25 > 91) {
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

