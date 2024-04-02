$(function () {
    'use strict'

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
    }
    var fontFamily = "'Roboto', Helvetica, sans-serif"

    // Monitoring Avg
    if ($('#Avg').length) {
        var options = {
            chart: {
                type: "line",
                height: 300,
            },
            series: [
                {
                    name: 'PM2.5',
                    data: [12, 15, 18, 21, 11, 20, 17, 19, 18, 23, 17, 19, 15, 18, 22, 14, 25, 20, 18, 23, 17, 19, 18, 23, 18, 23, 17, 19, 18, 23],
                },

                // Add more pollutants as needed
            ],
            xaxis: {
                type: 'datetime',
                categories: [
                    "2022-01-01T00:00:01",
                    "2022-01-01T00:00:02",
                    "2022-01-01T00:00:03",
                    "2022-01-01T00:00:04",
                    "2022-01-01T00:00:05",
                    "2022-01-01T00:00:06",
                    "2022-01-01T00:00:07",
                    "2022-01-01T00:00:08",
                    "2022-01-01T00:00:09",
                    "2022-01-01T00:00:10",
                    "2022-01-01T00:00:11",
                    "2022-01-01T00:00:12",
                    "2022-01-01T00:00:13",
                    "2022-01-01T00:00:14",
                    "2022-01-01T00:00:15",
                    "2022-01-01T00:00:16",
                    "2022-01-01T00:00:17",
                    "2022-01-01T00:00:18",
                    "2022-01-01T00:00:19",
                    "2022-01-01T00:00:20",
                    "2022-01-01T00:00:21",
                    "2022-01-01T00:00:22",
                    "2022-01-01T00:00:23",
                    "2022-01-01T00:00:24",
                    "2022-01-01T00:00:25",
                    "2022-01-01T00:00:26",
                    "2022-01-01T00:00:27",
                    "2022-01-01T00:00:28",
                    "2022-01-01T00:00:29",
                    "2022-01-01T00:00:30",
                ],
                labels: {
                    style: {
                        colors: 'var(--bs-body-color)', // Set the color of x-axis labels
                    },
                },
            },
            yaxis: {
                title: {
                    text: 'Concentration (µg/m³)',
                    style: {
                        color: 'var(--bs-body-color)', // Set the color of x-axis labels
                    },
                },
                labels: {
                    style: {
                        colors: 'var(--bs-body-color)', // Set the color of x-axis labels
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
        new ApexCharts(document.querySelector("#Avg"), options).render();
    }
    // Monitoring Avg - END


});

