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
        var ozone = latestData.map(function (item) {
            return item.ozone;
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

                show: false,
                offsetX: 0,
                offsetY: 0,
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
                    name: 'O3',
                    data: ozone
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
                    text: 'Concentration (ppm)',
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

            tooltip: {
                x: {
                    show: false,
                },
                marker: {
                    show: false,
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#o3"), options);
        chart.render();

        var intervalId;

        // Add event listeners to pause and resume chart update interval
        document.querySelector("#o3").addEventListener('mouseenter', function () {
            clearInterval(intervalId);
        });

        document.querySelector("#o3").addEventListener('mouseleave', function () {
            intervalId = setInterval(updateChart, 1000);
        });

        function updateChart() {
            $.ajax({
                url: '/o3-data',
                method: 'GET',
                success: function (data) {
                    var newDateTime = data.map(function (item) {
                        return item.dateTime;
                    });
                    var newO3 = data.map(function (item) {
                        return item.ozone;
                    });

                    // Update chart with only the latest 15 data points
                    var latestData = data.slice(-15);
                    chart.updateOptions({
                        xaxis: {
                            categories: newDateTime.slice(-15)
                        }
                    });

                    chart.updateSeries([{
                        data: newO3.slice(-15)
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
        url: '/o3-data',
        method: 'GET',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.log('Error fetching initial data:', error);
        }
    });

    $('#expO3').on('click', function () {
        $.ajax({
            url: '/o3-data',
            method: 'GET',
            success: function (data) {
                // Calculate average O3 values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "DateTime,O3 (ppm),Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgO3);
                    var healthImpact = getHealthImpact(classification);

                    var avgO3Formatted = item.avgO3.toFixed(3);

                    csvContent += item.dateTime + "," + avgO3Formatted + "," + classification + "," + healthImpact + "\n";

                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'o3-average-per-hour.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching O3 data:', error);
            }
        });
    });


    // Function to calculate average O3 values by hour
    function calculateAverageByHour(data) {
        var hourlyAverages = {};
        data.forEach(function (item) {
            var dateTimeParts = item.dateTime.split(' ');
            var date = dateTimeParts[0];
            var time = dateTimeParts[1];
            var hour = time.split(':')[0];

            var hourDateTime = date + ' ' + hour + ':00:00';
            if (!hourlyAverages[hourDateTime]) {
                hourlyAverages[hourDateTime] = { sumO3: 0, count: 0 };
            }
            hourlyAverages[hourDateTime].sumO3 += item.ozone;
            hourlyAverages[hourDateTime].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hourDateTime) {
            var avgO3 = hourlyAverages[hourDateTime].sumO3 / hourlyAverages[hourDateTime].count;
            result.push({ dateTime: hourDateTime, avgO3: avgO3 });
        });
        return result;
    }

    // Function to determine classification based on PM2.5 value
    function getClassification(ozone) {
        if (ozone >= 0 && ozone <= 0.064) {
            return "Good (Green)";
        } else if (ozone > 0.064 && ozone <= 0.084) {
            return "Moderate (Yellow)";
        } else if (ozone > 0.084 && ozone <= 0.104) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (ozone > 0.104 && ozone <= 0.124) {
            return "Unhealthy (Red)";
        } else if (ozone > 0.124 && ozone <= 0.374) {
            return "Very Unhealthy (Purple)";
        } else if (ozone > 0.375) {
            return "Hazardous (Maroon)";
        } else {
            return "Over values";
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
                return "Over values";
        }
    }
});
