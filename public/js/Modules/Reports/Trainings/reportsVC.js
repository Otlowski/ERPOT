var reportsVC = {};
    
    reportsVC.chartsData = null;
    
    reportsVC.initView = function() {
        reportsVC.createChart();
        reportsVC.createChart2();
        reportsVC.createChart3();
        reportsVC.createChart4();
        reportsVC.createChart5();
        reportsVC.createChart6();
        reportsVC.createChart7();
        reportsVC.createChart8();
        
    };
    
    //set colors of highcharts
    Highcharts.setOptions({
        colors: ['#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572']
    });
    

   reportsVC.createChart = function () { 
    
    var myChart = Highcharts.chart('chart', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'How satisfied they were with the course?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:-10,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Expected',58],
                ['Disapointed', 8],
                ['Delighted', 17],
                ['Ok',17],
                
               
            ]
        }]
    
    });
    
    };
    
   reportsVC.createChart2 = function () { 
 var myChart = Highcharts.chart('chart-two', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'How to asses the duration of training?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:10,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Ideal', 88],
                ['Too Long', 4],
                ['Too short',2]
               
            ]
        }]
    });
    };
    
   reportsVC.createChart3 = function () { 
    var myChart = Highcharts.chart('chart-three', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'Was the tempo fine?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:10,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [         
                ['Ideal', 83],
                ['Too quickly', 8],
                ['Too slow',9],
               
            ]
        }]
    }); 
    };
    
   reportsVC.createChart4 = function () { 
    var myChart = Highcharts.chart('chart-four', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'Whats your rate of this training?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:10,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Exciting', 13],
                ['Not Special',8],
                ['Intelligible', 79],
               
            ]
        }]
    }); 
    };
    
   reportsVC.createChart5 = function () { 
    var myChart = Highcharts.chart('chart-five', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'In your opinion is it expensive?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:15,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Cheap', 39],
                ['Too Expensive', 9],
                ['Ok',30],
                ['Should be cheaper',3],
                ['Exactly',19]
                
                    
               
            ]
        }]
    }); 
    };
    
   reportsVC.createChart6 = function () { 
    var myChart = Highcharts.chart('chart-six', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'How it affected for everyday work?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:15,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Profit', 54],
                ['Learned Something', 42],
                ['Everything is clear',4]
               
            ]
        }]
    }); 
    };
    
   reportsVC.createChart7 = function () { 
    var myChart = Highcharts.chart('chart-seven', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'How it affected for everyday work?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:15,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Profit', 54],
                ['Learned Something', 42],
                ['Everything is clear',4]
               
            ]
        }]
    }); 
    };
    
   reportsVC.createChart8 = function () { 
    var myChart = Highcharts.chart('chart-eight', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 30,
                beta: 0
            }
        },
        title: {
            text: 'How it affected for everyday work?'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 50,
                dataLabels: {
                    distance:15,
                    color:'black',
//                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Perecent of participants',
            data: [ 
                ['Profit', 54],
                ['Learned Something', 42],
                ['Everything is clear',4]
               
            ]
        }]
    }); 
    };
   
   
//   reportsVC.onClickSelector = function()
//   {
//       $('.chart-content').hide();
//   };
    
    reportsVC.initView();