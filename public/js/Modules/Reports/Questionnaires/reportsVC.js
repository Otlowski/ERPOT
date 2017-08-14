var reportsVC = {};
    
    reportsVC.chartsData = null;
    
    reportsVC.initView = function() {
        reportsVC.getChartQuestionnairesData();
    };
    
    
    reportsVC.getChartQuestionnairesData = function(dataParam) {
        var dataParam = {
            start_at :  "2016-06-01",
            finish_at:  "2016-09-01"
        };
        
        apiClient.post("/reports/showQuestionnairesStats", dataParam, function(response) {
            
            var $chart = $('[data-function=chart-questionnaire]');    // $('#idObject')  / $('.className') .. 
            var chartData = response.message.stats;
            var chartDataTotal = response.message.total;
            
            // foreach for Array
//            chartData.forEach( function(item,index) {
//                
//                var data = [ index , item]; // eg: ['2016-05-03' , 15]
//                serieTrainigs.data.push(data);
//            });
//            
             // foreach for Object
             
//             var max_seats_amount = {
//                 name   :   'max seats amount',
//                 data   :   []
//             }
             var users_amount = {
                 name   :   'users amount',
                 data   :   []
             }
             var questionnaires_amount = {
                 name   :   'questionnaires amount',
                 data   :   []
             }
             
            $.each(chartData, function(index,item) {
                
                chartQuestionnaires.settings.xAxis.categories.push(item.training_name);
//                var seats = [item.max_seats_amount];
                var users = [item.users_amount];
                var questionnaires = [item.questionnaires_amount];
                
//                max_seats_amount.data.push(seats);
                users_amount.data.push(users);
                questionnaires_amount.data.push(questionnaires);
            });
            
            chartQuestionnaires.settings.series = [];
//            chartQuestionnaires.settings.series.push(max_seats_amount);
            chartQuestionnaires.settings.series.push(users_amount);
            chartQuestionnaires.settings.series.push(questionnaires_amount);
            
            $chart.highcharts(chartQuestionnaires.settings);
        });
        
        
    };
    
    reportsVC.initView();