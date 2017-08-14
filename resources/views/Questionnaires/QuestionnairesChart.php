<html>
    <head>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

        <script type = text/javascript>
            $(document).ready(function(responseData) {
                
                var chart = {
                    type:   'column'
                };
                
                var title = {
                    text:   'Amount of trainings and questionnaires users.'
                };
                
                var subtitle = {
                    text:   ''
                };
                
                var xAxisCategories = [];
                var seriesData = [];
                var i = 0;
                for (var key in responseData.stats) {
                    xAxisCategories[i] = responseData.stats[key].training_name;
                    seriesData[i][0] = responseData.stats[key].max_seats_amount;
                    seriesData[i][1] = responseData.stats[key].users_amount;
                    seriesData[i][2] = responseData.stats[key].questionnaires_amount;
                    i++;
                }
                
                var xAxis = {
                    categories:    xAxisCategories,
                    crosshair:    true
                };
                
                var yAxis = {
                    min:    0,
                    title:  {
                        text:   'trainings amount'
                    }
                };
                
                plotOptions = {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                };
                
                var legend = {
                    enabled: false
                };
                
                var series = [];
                i = 0;
                for (var key in seriesData) {
                    series[i] = {
                        data:   seriesData[i];
                    }
                }
                
                var chartData = {};
                chartData.chart = chart;
                chartData.title = title;
                chartData.subtitle = subtitle;
                chartData.xAxis = xAxis;
                chartData.yAxis = yAxis;
                chartData.legend = legend;
                chartData.series = series;
                chartData.plotOptions = plotOptions;
                
                
                $('#container').highcharts(chartData);
            });
        </script>
    </body>>
</html>>