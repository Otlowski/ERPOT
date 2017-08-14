<html>
    <head>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
        <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

        <script type = text/javascript>
            $(document).ready(function(responseData) {
                
                var chart = {
                    type:   'column'
                };
                
                var title = {
                    text:   'Amount of trainings.'
                };
                
                var subtitle = {
                    text:   ''
                };
                
                var xAxisCategories = [];
                var seriesData = [];
                var i = 0;
                for (var key in responseData.message.stats) {
                    xAxisCategories[i] = key;
                    seriesData[i] = responseData.message.stats[key];
                    i++;
                }
                
                var xAxis = {
                    categories:    xAxisCategories,
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                };
                
                var yAxis = {
                    min:    0,
                    title:  {
                        text:   'trainings amount'
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
                
                dataLabels = {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
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
                chartData.dataLabels = dataLabels;
                
                
                $('#container').highcharts(chartData);
            });
        </script>
    </body>>
</html>>