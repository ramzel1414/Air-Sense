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
        var co = latestData.map(function (item) {
            return item.co;
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
                    name: 'CO',
                    data: co
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
        };

        var chart = new ApexCharts(document.querySelector("#co"), options);
        chart.render();

        var intervalId;

        // Add event listeners to pause and resume chart update interval
        document.querySelector("#co").addEventListener('mouseenter', function () {
            clearInterval(intervalId);
        });

        document.querySelector("#co").addEventListener('mouseleave', function () {
            intervalId = setInterval(updateChart, 1000);
        });

        function updateChart() {
            $.ajax({
                url: '/co-data',
                method: 'GET',
                success: function (data) {
                    var newDateTime = data.map(function (item) {
                        return item.dateTime;
                    });
                    var newCo = data.map(function (item) {
                        return item.co;
                    });

                    // Update chart with only the latest 15 data points
                    var latestData = data.slice(-15);
                    chart.updateOptions({
                        xaxis: {
                            categories: newDateTime.slice(-15)
                        }
                    });

                    chart.updateSeries([{
                        data: newCo.slice(-15)
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
        url: '/co-data',
        method: 'GET',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.log('Error fetching initial data:', error);
        }
    });


    // Attach click event listener to export CO data
    $('#expCO').on('click', function () {
        $.ajax({
            url: '/co-data',
            method: 'GET',
            success: function (data) {
                // Calculate average CO values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "DateTime,CO,Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgCO);
                    var healthImpact = getHealthImpact(classification);

                    var avgCOFormatted = item.avgCO.toFixed(1);

                    csvContent += item.dateTime + "," + avgCOFormatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'co-average-per-hour.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching CO data:', error);
            }
        });
    });

    // Function to calculate average CO values by date
    function calculateAverageByHour(data) {
        var hourlyAverages = {};
        data.forEach(function (item) {
            var dateTimeParts = item.dateTime.split(' ');
            var date = dateTimeParts[0];
            var time = dateTimeParts[1];
            var hour = time.split(':')[0];

            var dateTime = date + ' ' + time;

            if (!hourlyAverages[hour]) {
                hourlyAverages[hour] = { dateTime: dateTime, sumCO: 0, count: 0 };
            }
            hourlyAverages[hour].sumCO += item.co;
            hourlyAverages[hour].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hour) {
            var avgCO = hourlyAverages[hour].sumCO / hourlyAverages[hour].count;
            result.push({ dateTime: hourlyAverages[hour].dateTime, avgCO: avgCO });
        });

        return result;
    }


    // Function to determine classification based on PM10 value
    function getClassification(co) {
        if (co >= 0 && co <= 12) {
            return "Good (Green)";
        } else if (co > 12 && co <= 35) {
            return "Moderate (Yellow)";
        } else if (co > 35 && co <= 55) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (co > 55 && co <= 150) {
            return "Unhealthy (Red)";
        } else if (co > 150 && co <= 250) {
            return "Very Unhealthy (Purple)";
        } else if (co > 250 && co <= 500) {
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
