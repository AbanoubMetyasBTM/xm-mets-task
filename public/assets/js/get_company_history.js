function customRange(input) {

    if (input.id == 'txtEndDate') {
        var minDate = new Date($('#txtStartDate').val());
        minDate.setDate(minDate.getDate() + 1)

        return {
            minDate: minDate
        };
    }

}

var loadChart;

$(function () {
    var now = new Date();

    $('#txtStartDate, #txtEndDate').datepicker({
        showOn: "both",
        maxDate: now,
        beforeShow: customRange,
        dateFormat: "yy-mm-dd",
    });

    loadChart = function () {

        let pricesJson;

        try{
            pricesJson = JSON.parse($(".prices_json").val());
        }
        catch (e){
            return false;
        }

        var trace = {
            x: pricesJson.date,
            close: pricesJson.close,
            high: pricesJson.high,
            low: pricesJson.low,
            open: pricesJson.open,

            // cutomise colors
            increasing: {line: {color: 'black'}},
            decreasing: {line: {color: 'red'}},

            type: 'ohlc',
            xaxis: 'x',
            yaxis: 'y'
        };

        var data = [trace];

        var layout = {
            dragmode: 'zoom',
            showlegend: false,
            xaxis: {
                autorange: true,
                title: 'Date',
                rangeselector: {
                    x: 0,
                    y: 1.2,
                    xanchor: 'left',
                    font: {size: 8},
                    buttons: [{
                        step: 'month',
                        stepmode: 'backward',
                        count: 1,
                        label: '1 month'
                    }, {
                        step: 'month',
                        stepmode: 'backward',
                        count: 6,
                        label: '6 months'
                    }, {
                        step: 'all',
                        label: 'All dates'
                    }]
                }
            },
            yaxis: {
                autorange: true,
            }
        };

        Plotly.newPlot('chart_div', data, layout);
    }
    loadChart();


});
