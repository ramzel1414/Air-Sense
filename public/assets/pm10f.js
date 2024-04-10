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
        bodyColor: "#b8c3d9",
        cardBg: "#0c1427"
    }

    var fontFamily = "'Roboto', Helvetica, sans-serif"

    //  Real-Time Chart
    var data = [],
        totalPoints = 300;

    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk

        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }

    // Set up the control widget

    var updateInterval = 30;
    if ($("#pm10f").length) {
        var plot = $.plot("#pm10f", [getRandomData()], {
            series: {
                shadowSize: 0, // Drawing is faster without shadows
                lines: {
                    show: true,
                    lineWidth: 1,
                    fill: false,
                    opacity: 0.1
                }
            },
            xaxis: {
                // show: false,
            },
            yaxis: {
                min: 0,
                max: 150
            },
            grid: {
                color: 'rgba(77, 138, 240, 1)',
                borderColor: colors.gridBorder,
                borderWidth: 1,
                hoverable: true,
                clickable: true
            },
            colors: [colors.primary]

        });

        function update() {

            plot.setData([getRandomData()]);

            // Since the axes don't change, we don't need to call plot.setupGrid()

            plot.draw();
            setTimeout(update, updateInterval);
        }

        update();
    }

});
