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
                toolbar: {
                    show: true,
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
                    export: {
                        csv: {
                            filename: "Pollutant O3",
                            columnDelimiter: ',',
                            headerCategory: 'category',
                            headerValue: 'value',
                            dateFormatter(timestamp) {
                                return new Date(timestamp).toDateString()
                            }
                        },
                        svg: {
                            filename: "Pollutant O3",
                        },
                        png: {
                            filename: "Pollutant O3",
                        }
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
});
