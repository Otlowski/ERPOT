trainingEventAddVC = {};
trainingEventAddVC.$modal = $('#modal-event-add');
trainingEventAddVC.roomsContent = $("[data-function=rooms-content]");
trainingEventAddVC.usersContent = $("[data-function=users-content]");
trainingEventAddVC.trainingsContent = $("[data-function=trainings-content]");
trainingEventAddVC.userListRows = [];
trainingEventAddVC.trainingListRows = [];
trainingEventAddVC.roomObjectId = null;
trainingEventAddVC.groupId = null;
trainingEventAddVC.initView = function () 
{
   var choosenDate = $('#modal-trainings-list').find("input[name=selectedDate]").val();
   /*CLEAR FORM*/
   $("[data-function=training-name]").val('');
   $("[data-function=training-start]").val(choosenDate+' 01:00:00');
   $("[data-function=training-finish]").val(choosenDate+' 02:00:00');
   trainingEventAddVC.userListRows = [];
   trainingEventAddVC.trainingListRows = [];
   trainingEventAddVC.roomsContent.find('.content-table__col-details').html("");
   trainingEventAddVC.usersContent.find('.content-table__col-details').html("");
   trainingEventAddVC.trainingsContent.find('.content-table__col-details').html("");
   // list all items
   trainingEventAddVC.listUsers();
   trainingEventAddVC.listRooms();
   trainingEventAddVC.listTrainingsContents();
   //set Name and Date of Tranining Event
   trainingEventAddVC.setNameAndDateTime();
   //hide modal with trainigs-list
   $('[data-function=trainings-list]').modal('hide');
   //show adding form 
   $('[data-function=trainings-events-list]').modal('show');
   
   //automatic list rooms [1st tab]
   trainingEventAddVC.onRoomsTabClick();
   //set buttons
   $('[data-toggle=rooms-tab]').unbind("click")
                               .click(trainingEventAddVC.onRoomsTabClick);
   $('[data-toggle=users-tab]').unbind("click")
                               .click(trainingEventAddVC.onUsersTabClick);
   $('[data-toggle=trainings-contents-tab]').unbind("click")
                               .click(trainingEventAddVC.onTrainingsContentsTabClick);
   $('[data-toggle=add-event]').unbind("click")
                               .click(trainingEventAddVC.onAddEventClick);
   //choose TrainingGroup
   $("#select-group").change(function(){
        var groupId = $(this).val();
        trainingEventAddVC.setTrainingGroup(groupId);
   });
 
    //search fields keyup
    $("[data-function=search-room]").unbind("keyup")
                                    .keyup(trainingEventAddVC.onRoomsSearchKeyup);
    $("[data-function=search-user]").unbind("keyup")
                                    .keyup(trainingEventAddVC.onUsersSearchKeyup);   
    $("[data-function=search-training-content]")
                                    .unbind("keyup")
                                    .keyup(trainingEventAddVC.onTrainingsContentsSearchKeyup);   
           
};  
/*Name and Date method*/
trainingEventAddVC.setNameAndDateTime = function()
{
   //datetimpepickers inputs activated
   $("#datetimepicker-start").datetimepicker(
    {
        format: 'yyyy-mm-dd hh:ii:ss',
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        minTime:'10:00',
        maxTime:'20::00',
        startDate : new Date(),
        endDate : new Date('2017-12-31')
    }).on('changeDate', function (selected) {
        var selectedDate = new Date(selected.date);
        
        
        var year    = selectedDate.getFullYear();
        var month   = selectedDate.getMonth();
        var day     = selectedDate.getDate();
        var hours   = selectedDate.getHours();
        var minutes = selectedDate.getMinutes()+5;
        var endDate = new Date(year,month,day);
            endDate.setHours(23);
            endDate.setMinutes(55);
            endDate.setSeconds(0);
        month = month + 1;

        if(minutes < 55){ minutes = selectedDate.getMinutes()+5 ;};
        if (day <= 9) {
            day = '0' + day;
        }
        if (month <= 9) {
            var defaultDate = year + '-' + '0' + month + '-' + day + ' ' + hours + ':' + minutes + ':00';
        }
        else {
            var defaultDate = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':00'
        }
        $('#datetimepicker-finish').css({pointerEvents:'auto'});
        $('#datetimepicker-finish').datetimepicker('setStartDate', selectedDate);
        $('#datetimepicker-finish').datetimepicker('setEndDate', endDate);
        $('#datetimepicker-finish').val(defaultDate);     
    });;
   $("#datetimepicker-finish").datetimepicker(
    {
        format: 'yyyy-mm-dd hh:ii:ss',
        todayHighlight: 1,
        autoclose: 1,
    });
};
trainingEventAddVC.setTrainingGroup = function(groupId)
{
    trainingEventAddVC.groupId = groupId;
};
/*Rooms Tab methods*/
trainingEventAddVC.onRoomsTabClick = function() 
{
    //set button selected on click
    $('[data-toggle=users-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=trainings-contents-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=rooms-tab]').addClass('selected');
    
    //hide unneeded contents
    trainingEventAddVC.usersContent.hide();
    trainingEventAddVC.trainingsContent.hide();
    trainingEventAddVC.roomsContent.show();
};
trainingEventAddVC.listRooms = function ()
{
    var data = {};
    apiClient.post("/rooms/listRooms", data, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var roomsArray = trainingEventAddVC.roomsList = response.message;
        
        var $roomsTableContent = $('.rooms-list__content');
            $roomsTableContent.html("");
        roomsArray.forEach(function (room, index) {
           
           var roomRow = $(trainingEventAddVC.roomsListItemTpl);
               roomRow.find('.rooms-list__item-text').text('room '+room.number);
               roomRow.find('.rooms-list__item-plus').attr('data-room-object-id',room.object_id);
               roomRow.attr('room-object-id',room.object_id);
            $roomsTableContent.append(roomRow);

        });
        //no rooms selected [empty] content
            var roomDetails = trainingEventAddVC.roomsContent.find('.content-table__col-details');
                roomDetails.html("");
                roomDetails.append("<div class='no-select-item'>No Room Selected</div>");
                
        //set events
        $('.rooms-list').find("[data-toggle=select-room]")
                        .unbind("click")
                        .click(trainingEventAddVC.onSelectRoomClick); 
    });



};
trainingEventAddVC.onRoomsSearchKeyup = function()
{   
    var searchValue = $(this).val();
    var $roomsList =  $("[data-function=rooms-list]");
    // validation
        searchValue = typeof searchValue !== 'undefined' ? searchValue.toLowerCase() : '';
    // if empty search value
    if (searchValue === '') {
        $roomsList.find(".rooms-list__item").show();
        return;
    }

    var searchArray = searchValue.split(' ');
    if (searchArray[searchArray.length - 1] === '') {
        delete searchArray[searchArray.length - 1];
    }

    $roomsList.find(".rooms-list__item").hide();

    var rooms = trainingEventAddVC.findRoom(searchArray);

    rooms.forEach(function (room, index) {
        $roomsList.find('[room-object-id=' + room.object_id + ']').show();
    });

};
trainingEventAddVC.findRoom = function (searchArray) 
{
    var searchResult = [];
    searchResult = $.grep(trainingEventAddVC.roomsList, function (e) {
        var show = false;
        for (var i = 0, len = searchArray.length; i < len; i++) {
            if (e.number.toLowerCase().indexOf(searchArray[i]) !== -1) {
                show = true;
            }
        }
        return show;
    });

    return searchResult;
};
trainingEventAddVC.onSelectRoomClick = function()
{
    var roomChoosen = $(this);
    var roomObjectId = roomChoosen.attr('data-room-object-id');
    /*Add to global variable */
    trainingEventAddVC.roomObjectId = roomObjectId;
    /*Append Details about the room */
    var data =
    { 
        object_id : roomObjectId
    };
    apiClient.post("/rooms/detailsRoom", data, function (response) {
        
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var roomData = response.message;
            //clean table
        var roomDetailsTable = trainingEventAddVC.roomsContent.find('.content-table__col-details');
            roomDetailsTable.html("");    
            //append data to table
       
            roomData.forEach(function (item) {
            var roomDetailContent = $(trainingEventAddVC.roomsDetailsTpl);
                roomDetailContent.attr('room-object-id', item.object_id);
                roomDetailContent.find('.data-name').text('room '+item.number);
                roomDetailContent.find('.data-floor').text(item.floor);
                roomDetailContent.find('.data-seats').text(item.free_seats_amount);
                roomDetailContent.find('.data-location').text(item.location);
                roomDetailContent.find('.data-description').text(item.description);
                roomDetailContent.find("[data-toggle=remove-select]").attr('data-room-object-id',item.object_id);
                roomDetailsTable.append(roomDetailContent);
            });
            
            /*events*/
        $('.content-table__col-details').find("[data-toggle=remove-select]")
                                        .unbind("click")
                                        .click(trainingEventAddVC.onRemoveSelectClick);
    });
    
    //set selected row apart 
    //and disable other rows in the list
    $('.rooms-list__item').each(function () {
        if ($(this).attr('room-object-id') == roomObjectId) {
            $(this).css({background: "#cae8fb"})
                   .addClass('selected');
        }
        else{
            $(this).css({cursor:"not-allowed",color: "#c0c0c0",background: "#ffffff"})
                   .addClass("blocked");
            $(this).find('.rooms-list__item-plus')
                   .hide();
        }
    }); 
};
trainingEventAddVC.onRemoveSelectClick = function()
{   
    
    var roomObjectId = $(this).attr('data-user-object-id');
    //clean content and write there is no selected room
    if ($('.col-details__title').attr('user-object-id') == roomObjectId) {
        var roomDetailsTable = trainingEventAddVC.roomsContent.find('.content-table__col-details');
            roomDetailsTable.html("");
            roomDetailsTable.append("<div class='no-select-item'>No Room Selected</div>");
    }
    $('.rooms-list__item').each(function () {
    if ($(this).attr('room-object-id') == roomObjectId) {
        $(this).removeAttr("style")
               .removeClass('selected');
    }
    else{
        $(this).removeAttr("style");
        $(this).find('.rooms-list__item-plus')
               .show();
    }
    });
    //variable = null when click remove select
    trainingEventAddVC.roomObjectId = null;

};
/*Users Tab methods*/
trainingEventAddVC.onUsersTabClick = function()
{
   //set button selected on click
    $('[data-toggle=trainings-contents-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=rooms-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=users-tab]').addClass('selected');
    
    //hide unneeded contents
    trainingEventAddVC.trainingsContent.hide();
    trainingEventAddVC.roomsContent.hide();
    trainingEventAddVC.usersContent.show();
};
trainingEventAddVC.listUsers = function()
{
    var data = {};
    apiClient.post("/users/listUsers", data, function(response){
        
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var usersArray = trainingEventAddVC.usersList = response.message;
        
        var $usersTableContent = $('.users-list__content');
            $usersTableContent.html("");
        usersArray.forEach(function(user, index){
                
            var userRow = $(trainingEventAddVC.usersListItemTpl);
                userRow.find('.users-list__item-name').text(user.name);
                userRow.find('.users-list__item-plus').attr('data-user-object-id',user.object_id);
                userRow.attr('user-object-id',user.object_id);
            $usersTableContent.append(userRow);
        });
            //no rooms selected [empty] content
            var userListRows = trainingEventAddVC.userListRows;
            var usersDetails = trainingEventAddVC.usersContent.find('.content-table__col-details');
            //check previous choosing users
            if (typeof userListRows === 'undefined' || userListRows.length <= 0){
                usersDetails.html("");
                usersDetails.append("<div class='no-select-item'>No User Selected</div>");
            }
                
            //set events
            $('.users-list').find("[data-toggle=select-user]")
                            .unbind("click")
                            .click(trainingEventAddVC.onSelectUserClick);
    });   
};
trainingEventAddVC.onUsersSearchKeyup = function()
{
    var searchValue = $(this).val();
    var $roomsList = $("[data-function=users-list]");
    // validation
    searchValue = typeof searchValue !== 'undefined' ? searchValue.toLowerCase() : '';
    // if empty search value
    if (searchValue === '') {
        $roomsList.find(".users-list__item").show();
        return;
    }
    
    var searchArray = searchValue.split(' ');
    if (searchArray[searchArray.length - 1] === '') {
        delete searchArray[searchArray.length - 1];
    }

    $roomsList.find(".users-list__item").hide();

    var users = trainingEventAddVC.findUser(searchArray);

    users.forEach(function (user, index) {
        $roomsList.find('[user-object-id=' + user.object_id + ']').show();
    });   
};
trainingEventAddVC.findUser = function(searchArray)
{
    var searchResult = [];
    searchResult = $.grep(trainingEventAddVC.usersList, function (e) {
        var show = false;
        for (var i = 0, len = searchArray.length; i < len; i++) {
            if (e.name.toLowerCase().indexOf(searchArray[i]) !== -1) {
                show = true;
            }
        }
        return show;
    });
    return searchResult;
};
trainingEventAddVC.onSelectUserClick = function()
{
    var userChoosen = $(this);
    var userObjectId = userChoosen.attr('data-user-object-id');
    /*Append Details about the room */
    var data =
    { 
        object_id : userObjectId
    };
    apiClient.post("/users/detailsUser", data, function (response) {
        
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var userData = response.message;

            trainingEventAddVC.addUserToTable(userData[0]);

    });
    //hide selected user
    $('.users-list__item').each(function () {
        if ($(this).attr('user-object-id') == userObjectId) {
            $(this).hide();

        }
    }); 
    
    

};
trainingEventAddVC.addUserToTable = function(userData)
{
    //create array which will be appended
    var userListRows = trainingEventAddVC.userListRows;
                       trainingEventAddVC.userListRows.push(userData);
                       
    //clean details table and append title
    var usersDetailsTable = trainingEventAddVC.usersContent.find('.content-table__col-details');
        usersDetailsTable.html("");
        usersDetailsTable.append("<div class='col-details__title'>Select Users</div>");
    //create row for each user form array 
        userListRows.forEach(function (item) {
            var userDetailContent = $(trainingEventAddVC.usersDetailsTpl);
                userDetailContent.find('.col-data-user__name').text(item.name);
                userDetailContent.find('.col-data-user__email').text(item.email);
                userDetailContent.find('.col-data-user__phone').text(item.username);
                userDetailContent.find('.icon-remove').attr('data-user-object-id',item.object_id);
                userDetailContent.attr('user-object-id', item.object_id);
                usersDetailsTable.append(userDetailContent);

            });
            
    //set events
    $("[data-function=users-table-details]").find("[data-toggle=remove-user]")
                                            .unbind("click")
                                            .click(trainingEventAddVC.onRemoveUserClick);
};
trainingEventAddVC.onRemoveUserClick = function()
{
    var userObjectId = $(this).attr('data-user-object-id');
    //remove user from table
    $('.row-form').each(function () {
        if ($(this).attr('user-object-id') == userObjectId) {
            $(this).remove();
            //refresh List of Users
            trainingEventAddVC.refreshUserList(userObjectId);
        }
    });
   //remove training from global array
    var arrayAfterRemove = trainingEventAddVC.userListRows;
    $.each(arrayAfterRemove, function(i, el){
            if (this.object_id == userObjectId){
                arrayAfterRemove.splice(i, 1);
        }
    });
    var usersContent = trainingEventAddVC.usersContent.find('.row-form');
    //check is there any user in content
    if(usersContent.length <= 0 )
    {
        var usersDetailsTable = trainingEventAddVC.usersContent.find('.content-table__col-details');
            usersDetailsTable.html("");
            usersDetailsTable.append("<div class='no-select-item'>No User Selected</div>");
        //clean "memory" array
        trainingEventAddVC.userListRows = [];
            
    }
};
trainingEventAddVC.refreshUserList=function(objectId)
{  
    $('.users-list__item').each(function () {
        if ($(this).attr('user-object-id') == objectId) {
            $(this).show();
        }
    }); 
};
/*Trainings Contents Tab methods*/
trainingEventAddVC.onTrainingsContentsTabClick = function()
{
    //set button selected on click
    $('[data-toggle=rooms-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=users-tab]').removeClass('selected').addClass('unclicked');;
    $('[data-toggle=trainings-contents-tab]').addClass('selected');
    
    //hide unneeded contents
    trainingEventAddVC.usersContent.hide();
    trainingEventAddVC.roomsContent.hide();
    trainingEventAddVC.trainingsContent.show();
};
trainingEventAddVC.listTrainingsContents = function()
{   
    var data = {};
    apiClient.post("/trainings/listTrainingsContents", data, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var trainingsContentsArray = trainingEventAddVC.trainingsList = response.message;

        var $trainingsTableContent = $('.trainings-list__content');
            $trainingsTableContent.html("");
        trainingsContentsArray.forEach(function(training, index){
                
            var trainingRow = $(trainingEventAddVC.trainingsListItemTpl);
                trainingRow.find('.trainings-list__item-name').text(training.name);
                trainingRow.find('.trainings-list__item-plus').attr('data-training-id',training.id);
                trainingRow.attr('training-id',training.id);
            $trainingsTableContent.append(trainingRow);
        });
        
        //no rooms selected [empty] content
        var trainingListRows = trainingEventAddVC.trainingListRows;
        var trainingDetails = trainingEventAddVC.trainingsContent.find('.content-table__col-details');
        //check previous choosing users
        if (typeof trainingListRows === 'undefined' || trainingListRows.length <= 0){
            trainingDetails.html("");
            trainingDetails.append("<div class='no-select-item'>No Training Selected</div>");
        }
        //set events
        $('.trainings-list').find("[data-toggle=select-training]")
                            .unbind("click")
                            .click(trainingEventAddVC.onSelectTrainingClick);
    });
};
trainingEventAddVC.onTrainingsContentsSearchKeyup = function()
{   
    var searchValue = $(this).val();
    var $trainingsList = $("[data-function=trainings-contents-list]");
    // validation
    searchValue = typeof searchValue !== 'undefined' ? searchValue.toLowerCase() : '';
    // if empty search value
    if (searchValue === '') {
        $trainingsList.find(".trainings-list__item").show();
        return;
    }

    var searchArray = searchValue.split(' ');
    if (searchArray[searchArray.length - 1] === '') {
        delete searchArray[searchArray.length - 1];
    }

    $trainingsList.find(".trainings-list__item").hide();

    var trainings = trainingEventAddVC.findTrainingContent(searchArray);

    trainings.forEach(function (training, index) {
        $trainingsList.find('[training-id=' + training.id + ']').show();
    });   
};
trainingEventAddVC.findTrainingContent = function(searchArray)
{
    var searchResult = [];
    searchResult = $.grep(trainingEventAddVC.trainingsList, function (e) {
        var show = false;
        for (var i = 0, len = searchArray.length; i < len; i++) {
            if (e.name.toLowerCase().indexOf(searchArray[i]) !== -1) {
                show = true;
            }
        }
        return show;
    });
    return searchResult;
};
trainingEventAddVC.onSelectTrainingClick = function()
{
    var trainingChoosen = $(this);
    var trainingId = trainingChoosen.attr('data-training-id');
    /*Append Details about the training */
    var data =
    { 
        id : trainingId
    };
    apiClient.post("/trainings/detailsTrainingContent", data, function (response) {
        
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var trainingObject = response.message;
        //call up other function with received object
        trainingEventAddVC.addTrainingToTable(trainingObject);

    });
    //hide selected training
    $('.trainings-list__item').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).hide();

        }
    }); 
};
trainingEventAddVC.addTrainingToTable = function(trainingObject)
{
    //create array which will be appended
    var trainingListRows = trainingEventAddVC.trainingListRows;
                           trainingEventAddVC.trainingListRows.push(trainingObject);
                                   
    //clean details table and append title
    var trainingsDetailsTable = trainingEventAddVC.trainingsContent.find('.content-table__col-details');
        trainingsDetailsTable.html("");
        trainingsDetailsTable.append("<div class='col-details__title'>Select Trainings</div>");
        
        //create row for each user form array 
        trainingListRows.forEach(function (item) {
            var trainingDetailContent = $(trainingEventAddVC.trainingsDetailsTpl);
                trainingDetailContent.find('.col-data-training__name').text(item.name);
                trainingDetailContent.find('.col-data-training__description').text(item.description);
                trainingDetailContent.find('.chapters-button').text("chapters : "+item.training_chapter_count);
                trainingDetailContent.find('.icon-remove').attr('data-training-id',item.id);
                trainingDetailContent.attr('training-id', item.id);
                trainingsDetailsTable.append(trainingDetailContent);
            });
    //set events
    $("[data-function=trainings-table-details]").find("[data-toggle=remove-training]")
                                                .unbind("click")
                                                .click(trainingEventAddVC.onRemoveTrainingClick);
                           
                           
};
trainingEventAddVC.onRemoveTrainingClick = function()
{
    var trainingId = $(this).attr('data-training-id');
    $('.row-form').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).remove();
            //refresh List of Trainings
            trainingEventAddVC.refreshTrainingList(trainingId);
        }
    });
    //remove training from global array
    var arrayAfterRemove = trainingEventAddVC.trainingListRows;
    $.each(arrayAfterRemove, function(i, el){
            if (this.id == trainingId){
                arrayAfterRemove.splice(i, 1);
        }
    });
    var trainingContent = trainingEventAddVC.trainingsContent.find('.row-form');
    //check is there any training in content
    if(trainingContent.length <= 0 )
    {
        var trainingsDetailsTable = trainingEventAddVC.trainingsContent.find('.content-table__col-details');
            trainingsDetailsTable.html("");
            trainingsDetailsTable.append("<div class='no-select-item'>No Training Selected</div>");
        //clean "memory" array
        trainingEventAddVC.trainingListRows = [];
    }

};
trainingEventAddVC.refreshTrainingList = function(trainingId)
{
    $('.trainings-list__item').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).show();
        }
    });
};

trainingEventAddVC.onAddEventClick = function()
{
    //Initialize variables
    var eventName,eventStartAt,eventFinishAt;
    var groupId               = trainingEventAddVC.groupId;
    var roomsObjectId         = trainingEventAddVC.roomObjectId;
    var users                 = trainingEventAddVC.userListRows;
    var trainingsContents     = trainingEventAddVC.trainingListRows;
    var usersObjectIds        = [];
    var trainingsContentsIds  = [];
    
    //get value from inputs
    eventName     = $("[data-function=training-name]").val();
    eventStartAt  = $("[data-function=training-start]").val();
    eventFinishAt = $("[data-function=training-finish]").val();
   
    //push elements to arrays
    users.forEach(function (user, index) {
           usersObjectIds.push(user.object_id);
        });
    trainingsContents.forEach(function (training, index) {
           trainingsContentsIds.push(training.id);
        });
        
    //new "create" object
    var create = 
         {
            'trainings_groups__id':   groupId,
            'name'                :   eventName,
            'rooms__object_id'    :   roomsObjectId,
            'start_at'            :   eventStartAt,
            'finish_at'           :   eventFinishAt
         };
         console.log("eventStartAt: ",eventStartAt);
    //prepare all data for request
    var dataParams = 
        { 
            create                   : [create], 
            users__objects_ids       : usersObjectIds,
            trainings_contents__ids  : trainingsContentsIds
        };
        
     apiClient.post("/trainings/addEvent", dataParams, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        
        var modal = trainingEventAddVC.$modal;
            modal.modal("hide");
        
        var createdEvent = response.message;
        console.log("Check Object which has been created: ", createdEvent);
    });
    $('[data-function=calendar-content]').find('.calendar__day-number').removeClass('calendar__day__selected');
    $('[data-function=calendar-content]').find('.calendar__day').find('[date='+eventStartAt.substr(0,10)+']').addClass('calendar__day__selected');
};
/*TEMPLATES*/
/*Rooms Templates*/
trainingEventAddVC.roomsListItemTpl = [
    '<div class="rooms-list__item">',
        '<div class="rooms-list__item-content">',
           '<div class="rooms-list__item-label"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span></div>',
           '<div class="rooms-list__item-text"></div>',
           '<div class="rooms-list__item-plus" data-toggle="select-room">',
             '<i class="glyphicon glyphicon-plus glyphicon-blue"></i>',
           '</div>',
        '</div>',
    '</div>',
].join("\n");

trainingEventAddVC.roomsDetailsTpl = [
'<div class="col-details__title">Select Room</div>',
'<div style="border-bottom: 1px solid #ccc;">',
    '<div class="row-form">',
        '<div class="col-label">',
            '<label>Name</label>',
        '</div>',
        '<div class="col-data">',
            '<div id="name" class="data-text data-name"></div>',
        '</div>',
    '</div>',
    '<div class="row-form">',
        '<div class="col-label">',
            '<label>Floor</label>',
        '</div>',
        '<div class="col-data">',
            '<div id="floor" class="data-text data-floor"></div>',
        '</div>',
    '</div>',
    '<div class="row-form">',
        '<div class="col-label">',
            '<label>Seats Amount</label>',
        '</div>',
        '<div class="col-data">',
            '<div id="seats" class="data-text data-seats"></div>',
        '</div>',
    '</div>',
    '<div class="row-form">',
        '<div class="col-label">',
            '<label>Location</label>',
        '</div>',
        '<div class="col-data">',
            '<div id="location" class="data-text data-location"></div>', 
        '</div>',
    '</div>',
    '<div class="row-form">',
        '<div class="col-label">',
            '<label>Description</label>',
        '</div>',
        '<div class="col-data">',
            '<div id="description" class="data-text data-description"></div>' ,  
        '</div>',
    '</div>',
'</div>',
'<div class="col-details__buttons">',
    '<button type="button" class="btn right remove-room" data-toggle="remove-select">Remove selected room</button>',
'</div>'
].join("\n");

/*Users Templates*/
trainingEventAddVC.usersListItemTpl = [
    '<div class="users-list__item">',
        '<div class="users-list__item-content">',
           '<div class="users-list__item-label"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>',
           '<div class="users-list__item-name"></div>',
           '<div class="users-list__item-plus" data-toggle="select-user">',
             '<i class="glyphicon glyphicon-plus glyphicon-blue"></i>',
           '</div>',
        '</div>',
    '</div>',
].join("\n");


trainingEventAddVC.usersDetailsTpl = [

    '<div class="row-form">',
        '<div class="col-remove-user">',
            '<div class="icon-remove" data-toggle="remove-user"></div>',
        '</div>',
        '<div class="col-data-user">',
            '<div class="col-data-user__name"></div>',
            '<div class="col-data-user__email"></div>',
            '<div class="col-data-user__phone"></div>',
        '</div>',

].join("\n");

/*Trainings Contents Templates*/

trainingEventAddVC.trainingsListItemTpl = [
    '<div class="trainings-list__item">',
        '<div class="trainings-list__item-content">',
           '<div class="trainings-list__item-label"><span class="glyphicon glyphicon-education" aria-hidden="true"></span></div>',
           '<div class="trainings-list__item-name"></div>',
           '<div class="trainings-list__item-plus" data-toggle="select-training">',
             '<i class="glyphicon glyphicon-plus glyphicon-blue"></i>',
           '</div>',
        '</div>',
    '</div>',
].join("\n");

trainingEventAddVC.trainingsDetailsTpl = [
    '<div class="row-form">',
        '<div class="col-data-training">',
            '<div class="col-remove-training">',
                '<div class="icon-remove" data-toggle="remove-training"></div>',
            '</div>',
            '<div class="col-data-training__name"></div>',
            '<div class="col-data-training__description"></div>',
            '<div class="col-data-training__chapters">',
                '<div class="chapters-button"></div>',
            '</div>',
        '</div>',
    '</div>'
].join("\n");
