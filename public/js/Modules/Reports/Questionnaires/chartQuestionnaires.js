var chartQuestionnaires = {};
    chartQuestionnaires.settings = {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Amount of trainings and questionnaires users.'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'number of users / questionnaires'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [],
        xAxis: {
            categories: []
        }
    };