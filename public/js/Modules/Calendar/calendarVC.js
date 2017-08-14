calendarVC = {};
/*Groups variables*/
calendarVC.$tableContent = $("[data-function=groups-list__groups]");
calendarVC.tableView = $("[data-function=groups]");
calendarVC.groupsList = [];
/*Calendar variables*/
calendarVC.$calendarContent = $("[data-function=calendar-content]");
calendarVC.periodDates = [];
calendarVC.yearCalendar = {};

calendarVC.monthArray = {
    1:"January",
    2:"February",
    3:"March",
    4:"April",
    5:"May",
    6:"June",
    7:"July",
    8:"August",
    9:"Septeber",
    10:"October",
    11:"November",
    12:"December"
}
calendarVC.initView = function () {
    /*Get training groups*/
    calendarVC.getTrainingsEvents();
    calendarVC.getGroups();
    /*On day-cell click*/

    var selectedYear = 2017; //$('input[name=calendar-year]').val();
    calendarVC.periodDates = calendarVC.setDatesForYear(selectedYear);

    for (var m = 1; m <= 12; m++) {

        calendarVC.yearCalendar[m] = calendarVC.makeMountArray(selectedYear, m);
    }
    //clean content
    var $calendar = $('.col-calendar-content__wrapper');
        $calendar.html('');
        
    var $tableCalendarMonth = $('.calendar__month');
    
    //for each month aray and for each day form array insert data
    $.each( calendarVC.yearCalendar , function (monthIndex, month) {
        
        
        var $monthBox = $(calendarVC.templateMonthContent);
            $monthBox.find('.calendar__month-name').text(calendarVC.monthArray[monthIndex]);
        var $monthBoxContent = $monthBox.find('.calendar__month-content');
        
            
            $.each(month,function (dayIndex, day){
                    
                    var $dayCell = $(calendarVC.templateMonthDayCell);
                    var date = new Date(day);

                    // todo :: check if out of month
                    if( ( date.getMonth() + 1 )  != monthIndex) {
                        $dayCell.css({"color":"#999"});
                        
                    }                      
                    if( date.getDay() == 0 || date.getDay() == 6 ) {
                        $dayCell.addClass('calendar__day--weekend');
                    }
                    
                    //add 1 to month
                    var monthConverted = date.getMonth()+1;
                    var dayConverted = date.getDate();
                    //Months and days with two digits
                    if(monthConverted<10){ monthConverted = '0' + monthConverted; };
                    if(dayConverted<10)  {dayConverted    = '0' + dayConverted; };
                    //Convert date to could append
                    var dateConverted = date.getFullYear()
                                        +'-'+monthConverted
                                        +'-'+dayConverted;

                    //add attribute with date to day cell
                    $dayCell.find('.calendar__day-number').text( date.getDate() ).attr('date',dateConverted);
                
                $monthBoxContent.append($dayCell);
                
            });

            $calendar.append($monthBox);
    });
  //event dbl click in day - cell
        var $calendarDay = calendarVC.$calendarContent.find('.calendar__month-content')
                                                      .find('.calendar__day-number')
                                                      .click(calendarVC.onDayCellClick);
        return;
        calendarVC.getMonth(2017);
};
calendarVC.setDatesForYear = function (year) {

    var datesArray = [];
    var date = new Date(year - 1 + '-12-01 00:00:00');

    for (var i = 1; i < 420; i++) {
        datesArray.push(date.toDateString());
        var nextDate = new Date(date.getTime() + 24 * 60 * 60 * 1000);
        date = nextDate;
    }

    return datesArray;
};
calendarVC.makeMountArray = function (year, month) {
    var dateFirst = new Date(year + '-' + month + '-01 00:00:00');
    var weekDayNumber = dateFirst.getDay()+6;
    var position = calendarVC.periodDates.indexOf(dateFirst.toDateString());

    var startAtIndex = position - weekDayNumber;
    var monthArray = calendarVC.periodDates.slice(startAtIndex, startAtIndex + 42);
    
    return monthArray;
};
calendarVC.getTrainingsEvents = function(){
    
    var dataParam = {
    };
    apiClient.post("/trainings/listTrainingsEvents", dataParam, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var trainingsEvents = response.message;
        
        trainingsEvents.forEach(function(event,index){
            var startAt = event.start_at.substr(0,10);
            var finishAt = event.finish_at.substr(0,10);
            var flagCellDay = calendarVC.$calendarContent.find('[date='+event.start_at.substr(0,10)+']');
            
            if(startAt == finishAt){
                flagCellDay.addClass('calendar__day__square');
            }
        });
    });
};
calendarVC.getGroups = function () {

    var dataParam = {
    };
    apiClient.post("/trainings/listTrainingsGroups", dataParam, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        // if success
        var groupsList = calendarVC.groupsList = response.message;
        calendarVC.$tableContent.html("");
        
        var dotColorTable = [
            "dot-label--green",
            "dot-label--red",
            "dot-label--yellow",
            "dot-label--blue",
            "dot-label--gray",
            "dot-label--purpre",
            "dot-label--silver",
            "dot-label--orange",
        ];
                
        groupsList.forEach(function (group, index) {
            var $groupTpl = $(calendarVC.trainingsGroupsItemTpl);
            $groupTpl.find('.groups-list__item-text').text(group.name);
            $groupTpl.attr('id', group.id);
            $groupTpl.attr('data-training-group-id', group.id);
            
            //choose color of dots for different groups
            var color = dotColorTable[index];
            
            $groupTpl.find('.dot-label').addClass(color);

            //events
            calendarVC.$tableContent.append($groupTpl);

            $groupTpl.click(calendarVC.onTrainingGroupClick);

        });
    });
};
calendarVC.onTrainingGroupClick = function (e) {

    calendarVC.tableView.find('.groups-list__item').removeClass('groups-list__item--selected');
    calendarVC.$tableContent.find('.groups-list__item').removeClass('groups-list__item--selected');
    var $group = $(this);
    $group.addClass('groups-list__item--selected');

    var dataParam = {
        id: $group.attr('data-training-group-id')
    };

    apiClient.post("/trainings/detailsTrainingsGroups",dataParam,function(response){
            // if error
            if("success" != response.status) { showAlert(response); return; }
            //if success
            var trainingGroupData = response.message;
            var trainingsArray = trainingGroupData.trainings;
            calendarVC.createTrainingsDays(trainingsArray);
            
        });
    
    
    e.stopPropagation();
};
calendarVC.createTrainingsDays = function(trainingsArray){

    
    var calendarContent = calendarVC.$calendarContent;
    //create color days
    
    trainingsArray.forEach(function(training){

        
        var trainingDate          = training.start_at.slice(0,10);

        
        var cellDate = calendarContent.find('.calendar__day').find('[date='+trainingDate+']');
        
        //if call has been found add color deppended from data-training id
        var groupsList =$('.groups-list__content').find('.groups-list__item--selected');
        
        
        var chooseColor   =   groupsList.attr('data-training-group-id');

        if (chooseColor == 1){
            //remove Classes with other colors 
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red')
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
            //add class with correct color                
                var cellColor = cellDate.addClass('calendar__day__green').fadeIn("slow");
            }
        if (chooseColor == 2){
           
                var hiddenColors = calendarContent.find('.calendar__day__green').removeClass('calendar__day__green');
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
            
                var cellColor = cellDate.addClass('calendar__day__red'); 
        }
       if (chooseColor == 3){
           
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red');
                                   calendarContent.find('.calendar__day__green').removeClass('calendar__day__green')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
            
                var cellColor = cellDate.addClass('calendar__day__yellow'); 
        }
        if (chooseColor == 4){
            
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red');
                                   calendarContent.find('.calendar__day__green').removeClass('calendar__day__green')
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
                var cellColor = cellDate.addClass('calendar__day__blue'); 
        }
        if (chooseColor == 5){
            
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red');
                                   calendarContent.find('.calendar__day__green').removeClass('calendar__day__green')
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
                var cellColor = cellDate.addClass('calendar__day__gray'); 
        }
        if (chooseColor == 6){
            
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red');
                                   calendarContent.find('.calendar__day__green').removeClass('calendar__day__green')
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__silver').removeClass('calendar__day__silver')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                var cellColor = cellDate.addClass('calendar__day__purpure'); 
        }
        if (chooseColor == 7){
            
                var hiddenColors = calendarContent.find('.calendar__day__red').removeClass('calendar__day__red');
                                   calendarContent.find('.calendar__day__green').removeClass('calendar__day__green')
                                   calendarContent.find('.calendar__day__yellow').removeClass('calendar__day__yellow')
                                   calendarContent.find('.calendar__day__blue').removeClass('calendar__day__blue')
                                   calendarContent.find('.calendar__day__purpure').removeClass('calendar__day__purpure')
                                   calendarContent.find('.calendar__day__gray').removeClass('calendar__day__gray')
                var cellColor = cellDate.addClass('calendar__day__silver'); 
        }
     });
        
};
calendarVC.onDayCellClick = function(e)
{
 
   //remove selected class from all contents
   $('.calendar__day').find('.calendar__day-number').removeClass('calendar__day__selected');
                                                    
        
   var $cell = $(this);
   //remove all colors and add selected class
       $cell.removeClass('calendar__day__yellow')
            .removeClass('calendar__day__blue')
            .removeClass('calendar__day__gray')
            .removeClass('calendar__day__silver')
            .removeClass('calendar__day__purpure')
            .removeClass('calendar__day__green')
            .addClass('calendar__day__selected');
            
    
    //string local date : midnight
    var stringDate = new Date($cell.attr('date')+' 00:00:00');
    //parse date to ISO String (UTC)
    var parsedDate = stringDate.toISOString();

    var dataParam = {   
        date : parsedDate
    };

    trainingsList.displayTrainingsDay(dataParam);
    

};

calendarVC.templateMonthContent = [
    '<div class="calendar__month col col-25">',
    '   <div class="calendar__month-name">',
    '   </div>',
    '   <div class="calendar__month-content" data-function="month">',
    '       <div class="calendar__week row">',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label">Mo</div>',
    '           </div>',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label">Tu</div>',
    '           </div>',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label">We</div>',
    '           </div>',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label">Th</div>',
    '           </div>',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label">Fr</div>',
    '           </div>',
    '           <div class="calendar__day col ">',
    '               <div class="calendar__day-label calendar__day-label--red">Sa</div>',
    '           </div>',
    '           <div class="calendar__day col">',
    '               <div class="calendar__day-label calendar__day-label--red">Su</div>',
    '           </div>',
    '     </div>',
    '   </div>',
    '</div>'
].join("\n");

calendarVC.templateMonthDayCell = [
    '<div class="calendar__day col">',
    '   <div class="calendar__day-number"></div>',
    '</div>',
].join("\n");

/*Groups template*/

calendarVC.trainingsGroupsItemTpl = [
    '<div class="groups-list__item">',
    '    <div class="groups-list__item-content">',
    '        <div class="groups-list__item-label">',
    '          <i class="glyphicon glyphicon-folder-open"></i>',
    '        </div>',
    '        <div class="groups-list__item-text"> [group_name] </div>',
    '        <div class="groups-list__item-label-dot">',
    '           <div class="dot-label"></div>',
    '        </div>',
    '    </div>',
    '</div>'
].join("\n");

calendarVC.initView();
