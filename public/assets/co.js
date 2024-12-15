$(function () {
    'use strict';

    function renderChart(data) {
        // Retrieve only the latest 20 data points
        const latestData = data.slice(-20);

        const dateTime = latestData.map((item) => item.dateTime);
        const co = latestData.map((item) => item.co);

        // Set all color stops to yellow (#ffce63)
        const colorStops = [
            { offset: 0, color: '#ffce63', opacity: 1 }, // Start with yellow
            { offset: 100, color: '#ffce63', opacity: 1 } // End with yellow
        ];

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
                    name: "CO",
                    data: co
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
        const chart = new ApexCharts(document.querySelector("#co"), options);
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
        $('#processing-co').show();
        $('#download-csv-co').hide();
        $.ajax({
            url: '/co-data',
            method: 'GET',
            success: function (data) {
                // Calculate average CO values by hour
                var averageData = calculateAverageByHour(data);

                // Generate CSV content with classification
                var csvContent = "DateTime,CO (ppm),Classification,Health Impact\n";
                averageData.forEach(function (item) {
                    var classification = getClassification(item.avgCO);
                    var healthImpact = getHealthImpact(classification);

                    var avgCOFormatted = item.avgCO.toFixed(0);

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
            },
            complete: function () {
                $('#processing-co').hide();
                $('#download-csv-co').show();
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

            var hourDateTime = date + ' ' + hour + ':00:00';
            if (!hourlyAverages[hourDateTime]) {
                hourlyAverages[hourDateTime] = { sumCO: 0, count: 0 };
            }
            hourlyAverages[hourDateTime].sumCO += item.co;
            hourlyAverages[hourDateTime].count++;
        });

        var result = [];
        Object.keys(hourlyAverages).forEach(function (hourDateTime) {
            var avgCO = hourlyAverages[hourDateTime].sumCO / hourlyAverages[hourDateTime].count;
            result.push({ dateTime: hourDateTime, avgCO: avgCO });
        });
        return result;
    }

    // DAILY
    $('#expCODaily').on('click', function () {
        $('#processing-co').show();
        $('#download-csv-co').hide();
        $.ajax({
            url: '/co-data',
            method: 'GET',
            success: function (data) {
                // Calculate daily average CO values
                var dailyAverageData = calculateAverageByDay(data);

                // Sort dailyAverageData array by dateTime (ascending order)
                dailyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Date,CO,Classification,Health Impact\n";
                dailyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgCO);
                    var healthImpact = getHealthImpact(classification);
                    var avgCOFormatted = item.avgCO.toFixed(0);

                    csvContent += item.dateTime + "," + avgCOFormatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'co-average-per-day.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-co').hide();
                $('#download-csv-co').show();
            }
        });
    });

    function calculateAverageByDay(data) {
        var dailyAverages = {};

        data.forEach(function (item) {
            var date = item.dateTime.split(' ')[0];

            if (!dailyAverages[date]) {
                dailyAverages[date] = { sumCO: 0, count: 0 };
            }

            dailyAverages[date].sumCO += item.co;
            dailyAverages[date].count++;
        });

        var result = [];
        Object.keys(dailyAverages).forEach(function (date) {
            var avgCO = dailyAverages[date].sumCO / dailyAverages[date].count;
            result.push({ dateTime: date, avgCO: avgCO });
        });

        return result;
    }


    // MONTHLY
    $('#expCOMonthly').on('click', function () {
        $('#processing-co').show();
        $('#download-csv-co').hide();
        $.ajax({
            url: '/co-data',
            method: 'GET',
            success: function (data) {
                // Calculate monthly average CO values
                var monthlyAverageData = calculateAverageByMonth(data);

                // Sort monthlyAverageData array by dateTime (ascending order)
                monthlyAverageData.sort((a, b) => {
                    return new Date(a.dateTime) - new Date(b.dateTime);
                });

                // Generate CSV content with classification
                var csvContent = "Month,CO,Classification,Health Impact\n";
                monthlyAverageData.forEach(function (item) {
                    var classification = getClassification(item.avgCO);
                    var healthImpact = getHealthImpact(classification);
                    var avgCOFormatted = item.avgCO.toFixed(0);

                    csvContent += item.dateTime + "," + avgCOFormatted + "," + classification + "," + healthImpact + "\n";
                });

                // Download CSV file
                var blob = new Blob([csvContent], { type: 'text/csv' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'co-average-per-month.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            },
            complete: function () {
                $('#processing-co').hide();
                $('#download-csv-co').show();
            }
        });
    });

    function calculateAverageByMonth(data) {
        var monthlyAverages = {};

        data.forEach(function (item) {
            var date = new Date(item.dateTime);
            var monthYearKey = date.getFullYear() + '-' + (date.getMonth() + 1);

            if (!monthlyAverages[monthYearKey]) {
                monthlyAverages[monthYearKey] = { sumCO: 0, count: 0 };
            }

            monthlyAverages[monthYearKey].sumCO += item.co;
            monthlyAverages[monthYearKey].count++;
        });

        var result = [];
        Object.keys(monthlyAverages).forEach(function (monthYearKey) {
            var avgCO = monthlyAverages[monthYearKey].sumCO / monthlyAverages[monthYearKey].count;
            var [year, month] = monthYearKey.split('-');
            var monthYear = `${year}-${month}`;

            result.push({ dateTime: monthYear, avgCO: avgCO });
        });

        return result;
    }

    // Function to determine classification based on PM10 value
    function getClassification(co) {
        if (co >= 0 && co <= 25) {
            return "Good (Green)";
        } else if (co > 25 && co <= 50) {
            return "Moderate (Yellow)";
        } else if (co > 50 && co <= 69) {
            return "Unhealthy for Sensitive Groups (Orange)";
        } else if (co > 69 && co <= 150) {
            return "Unhealthy (Red)";
        } else if (co > 150 && co <= 400) {
            return "Very Unhealthy (Purple)";
        } else if (co > 400) {
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
