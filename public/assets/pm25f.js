if ($('#pm25f').length) {
    // Make an AJAX request to fetch the data from the endpoint
    $.ajax({
        url: '/pm25-data-forecast',
        method: 'GET',
        success: function (response) {
            // Extract the Date and ForecastPM25 values from the response
            var data = response.map(function (item) {
                return {
                    x: new Date(item.Date),
                    y: item.ForecastPM25
                };
            });

            var options = {
                chart: {
                    type: "line",
                    height: 400,

                    toolbar: {
                        show: true,
                        offsetX: 0,
                        offsetY: 0,
                        export: {
                            csv: {
                                filename: "PM2.5 Forecast Yr. 2024",
                                columnDelimiter: ',',
                                headerCategory: 'Date',
                                headerValue: 'value',
                            },
                            svg: {
                                filename: "PM2.5 Forecast Yr. 2024",
                            },
                            png: {
                                filename: "PM2.5 Forecast Yr. 2024",
                            }
                        },
                        autoSelected: 'zoom'
                    },
                },

                series: [
                    {
                        name: 'PM2.5',
                        data: data,
                    },
                ],

                xaxis: {
                    type: 'datetime',
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

                noData: {
                    text: "No Data",
                    align: 'center',
                    verticalAlign: 'middle',
                    offsetX: 0,
                    offsetY: 0,
                    style: {
                        color: 'var(--bs-body-color)',
                        fontSize: '18px',
                    }
                },

                stroke: {
                    width: 2,
                    curve: "smooth"
                },



            };
            new ApexCharts(document.querySelector("#pm25f"), options).render();
        },
        error: function (error) {
            console.log(error);
        }
    });
}


