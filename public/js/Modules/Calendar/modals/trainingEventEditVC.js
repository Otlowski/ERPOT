trainingEventEditVC = {};
trainingEventEditVC.$modal = $('#modal-event-edit');
trainingEventEditVC.roomsContent = $("[data-function=rooms-content]");
trainingEventEditVC.usersContent = $("[data-function=users-content]");
trainingEventEditVC.trainingsContent = $("[data-function=trainings-content]");
trainingEventEditVC.userListRows = [];
trainingEventEditVC.trainingListRows = [];
trainingEventEditVC.roomObjectId = null;
trainingEventEditVC.eventGroup   = null;
trainingEventEditVC.initView = function (dataResponse)
{
    /*Assign Values For Global Variables*/
    var trainingEvent   = dataResponse.training_event;
    var eventGroup      = trainingEventEditVC.eventGroup   = trainingEvent[0].trainings_groups__id;
    var eventName       = trainingEventEditVC.eventName    = trainingEvent[0].name;
    var eventId         = trainingEventEditVC.id           = trainingEvent[0].id;
    var eventStart      = trainingEventEditVC.startDate    = trainingEvent[0].start_at;
    var eventFinish     = trainingEventEditVC.finishDate   = trainingEvent[0].finish_at;
    var roomsObjectId   = trainingEventEditVC.roomObjectId = trainingEvent[0].rooms__object_id;
    var users = [];
        users = dataResponse.trainings_users;
    var trainingsContents = [];
        trainingsContents = dataResponse.trainings_contents;
    /*CLEAR FORM*/
    $("[data-function=training-name]").val(eventName);
    $("[data-function=training-start]").val(eventStart);
    $("[data-function=training-finish]").val(eventFinish);
    trainingEventEditVC.userListRows = [];
    trainingEventEditVC.trainingListRows = [];
    trainingEventEditVC.roomsContent.find('.content-table__col-details').html("");
    trainingEventEditVC.usersContent.find('.content-table__col-details').html("");
    trainingEventEditVC.trainingsContent.find('.content-table__col-details').html("");
    
    // list all items
    /*ROOMS*/
    trainingEventEditVC.listRooms();
    trainingEventEditVC.onSelectRoomClick(roomsObjectId);
    /*USERS*/
    //check if array is right
    if(typeof(users) !== 'undefined' &&  users.length > 0){
        users.forEach(function (user, index) {
            var objectId = user.users__object_id;
            trainingEventEditVC.onSelectUserClick(objectId);
        });
    }
    else{trainingEventEditVC.listUsers();}
    /*CONTENTS*/
    //check if array is right
    if(typeof(trainingsContents) !== 'undefined' &&  trainingsContents.length > 0){
        trainingsContents.forEach(function (training, index) {
            var trainingId = training.id;
            trainingEventEditVC.onSelectTrainingClick(trainingId);
        });
    }
    else{trainingEventEditVC.listTrainingsContents();}

    //hide modal with trainigs-list
    $('[data-function=trainings-list]').modal('hide');
    $('[data-function=trainings-events-list]').modal('hide');
    //show adding form 
    $('[data-function=training-event-edit]').modal('show');
    //change event's dates
    trainingEventEditVC.changeEventDates();
    //automatic list rooms [1st tab]
    trainingEventEditVC.onRoomsTabClick();
    //set buttons
    $('[data-toggle=rooms-tab]').unbind("click")
            .click(trainingEventEditVC.onRoomsTabClick);
    $('[data-toggle=users-tab]').unbind("click")
            .click(trainingEventEditVC.onUsersTabClick);
    $('[data-toggle=trainings-contents-tab]').unbind("click")
            .click(trainingEventEditVC.onTrainingsContentsTabClick);
    $('[data-toggle=add-event]').unbind("click")
            .click(trainingEventEditVC.onEditEventClick);

    //search fields keyup
    $("[data-function=search-room]").unbind("keyup")
            .keyup(trainingEventEditVC.onRoomsSearchKeyup);
    $("[data-function=search-user]").unbind("keyup")
            .keyup(trainingEventEditVC.onUsersSearchKeyup);
    $("[data-function=search-training-content]")
            .unbind("keyup")
            .keyup(trainingEventEditVC.onTrainingsContentsSearchKeyup);

    //set training group
    $('option[value='+eventGroup+']').attr('selected',true);
    //on change Group
    $(".modal-body__select-group").find('#select-group').change(function(){
            var groupId = $(this).val();
            trainingEventEditVC.setTrainingGroup(groupId);
    });
    //Title inputs
    $("[data-function=training-name]").unbind("keyup")
                                      .keyup(trainingEventEditVC.setEventName);
    //set Date and Time
    
};       

trainingEventEditVC.changeEventDates = function()
{
    $("#datetime-start").datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        autoclose: 1,
        todayHighlight: 1, })
            .on('change.dp', function (e) {
                var selectedDate = trainingEventEditVC.startDate = $(this).val();
                selectedDate = new Date(selectedDate);

                var year = selectedDate.getFullYear();
                var month = selectedDate.getMonth();
                var day = selectedDate.getDate();
                var hours = selectedDate.getHours();
                var minutes = selectedDate.getMinutes();
                var endDate = new Date(year, month, day);
                    endDate.setHours(23);
                    endDate.setMinutes(59);
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
                $('#datetime-finish').css({pointerEvents: 'auto'});
                $('#datetime-finish').datetimepicker('setStartDate', selectedDate);
                $('#datetime-finish').datetimepicker('setEndDate', endDate);
                $('#datetime-finish').val(defaultDate);
            });
    $("#datetime-finish").datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        autoclose: 1,
        todayHighlight: 1,
    })
            .on('change.dp', function (e) {
                trainingEventEditVC.finishDate = $(this).val();
                console.log(trainingEventEditVC.finishDate);
            });
};
/*Rename Event method*/   
trainingEventEditVC.setEventName = function ()
{
    
    trainingEventEditVC.eventName = this.value;
};
trainingEventEditVC.setTrainingGroup = function(groupId)
{
    trainingEventEditVC.eventGroup = groupId;
};
///*Rooms Tab methods*/
trainingEventEditVC.onRoomsTabClick = function ()
{
    //set button selected on click
    $('[data-toggle=users-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=trainings-contents-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=rooms-tab]').addClass('selected');

    //hide unneeded contents
    trainingEventEditVC.usersContent.hide();
    trainingEventEditVC.trainingsContent.hide();
    trainingEventEditVC.roomsContent.show();
};
trainingEventEditVC.listRooms = function ()
{
    var data = {};
    apiClient.post("/rooms/listRooms", data, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var roomsArray = trainingEventEditVC.roomsList = response.message;

        var $roomsTableContent = $('.rooms-list__content');
        $roomsTableContent.html("");
        roomsArray.forEach(function (room, index) {

            var roomRow = $(trainingEventEditVC.roomsListItemTpl);
            roomRow.find('.rooms-list__item-text').text('room ' + room.number);
            roomRow.find('.rooms-list__item-plus').attr('data-room-object-id', room.object_id);
            roomRow.attr('room-object-id', room.object_id);
            $roomsTableContent.append(roomRow);

        });
        //no rooms selected [empty] content
//            var roomDetails = trainingEventEditVC.roomsContent.find('.content-table__col-details');
//                roomDetails.html("");
//                roomDetails.append("<div class='no-select-item'>No Room Selected</div>");

        //set events
        $('.rooms-list').find("[data-toggle=select-room]")
                .unbind("click").click(trainingEventEditVC.onSelectRoomClick);

    });
};
trainingEventEditVC.onRoomsSearchKeyup = function ()
{
    var searchValue = $(this).val();
    var $roomsList = $("[data-function=rooms-list]");
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

    var rooms = trainingEventEditVC.findRoom(searchArray);

    rooms.forEach(function (room, index) {
        $roomsList.find('[room-object-id=' + room.object_id + ']').show();
    });

};
trainingEventEditVC.findRoom = function (searchArray)
{
    var searchResult = [];
    searchResult = $.grep(trainingEventEditVC.roomsList, function (e) {
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
trainingEventEditVC.onSelectRoomClick = function ()
{
    var objectId = arguments[0];

    if (typeof objectId == 'string')
    {
        var roomObjectId = objectId;
        /*Add to global variable*/
        trainingEventEditVC.roomObjectId = roomObjectId;
    }
    else {
        var roomChoosen = $(this);
        var roomObjectId = roomChoosen.attr('data-room-object-id');
        /*Add to global variable */
        trainingEventEditVC.roomObjectId = roomObjectId;
    }
    /*Append Details about the room */
    var data =
            {
                object_id: trainingEventEditVC.roomObjectId
            };
    apiClient.post("/rooms/detailsRoom", data, function (response) {

        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var roomData = response.message;
        //clean table
        var roomDetailsTable = trainingEventEditVC.roomsContent.find('.content-table__col-details');
        roomDetailsTable.html("");
        //append data to table

        roomData.forEach(function (item) {
            var roomDetailContent = $(trainingEventEditVC.roomsDetailsTpl);
            roomDetailContent.attr('room-object-id', item.object_id);
            roomDetailContent.find('.data-name').text('room ' + item.number);
            roomDetailContent.find('.data-floor').text(item.floor);
            roomDetailContent.find('.data-seats').text(item.free_seats_amount);
            roomDetailContent.find('.data-location').text(item.location);
            roomDetailContent.find('.data-description').text(item.description);
            roomDetailContent.find("[data-toggle=remove-select]").attr('data-room-object-id', item.object_id);
            roomDetailsTable.append(roomDetailContent);
        });

        /*events*/
        $('.content-table__col-details').find("[data-toggle=remove-select]")
                .unbind("click")
                .click(trainingEventEditVC.onRemoveSelectClick);
    });

    $('.rooms-list__item').each(function (index, item) {

        if ($(this).attr('room-object-id') == roomObjectId) {
            $(this).css({background: "#cae8fb"})
                    .addClass('selected');
        }
        else {
            $(this).css({cursor: "not-allowed", color: "#c0c0c0", background: "#ffffff"})
                    .addClass("blocked");
            $(this).find('.rooms-list__item-plus')
                    .hide();
        }
    });
};
trainingEventEditVC.onRemoveSelectClick = function ()
{
    var roomObjectId = $(this).attr('data-user-object-id');
    //clean content and write there is no selected room
    if ($('.col-details__title').attr('user-object-id') == roomObjectId) {
        var roomDetailsTable = trainingEventEditVC.roomsContent.find('.content-table__col-details');
        roomDetailsTable.html("");
        roomDetailsTable.append("<div class='no-select-item'>No Room Selected</div>");
    }
    $('.rooms-list__item').each(function () {
        if ($(this).attr('room-object-id') == roomObjectId) {
            $(this).removeAttr("style")
                    .removeClass('selected');
        }
        else {
            $(this).removeAttr("style");
            $(this).find('.rooms-list__item-plus')
                    .show();
        }
    });
    //variable = null when click remove select
    trainingEventEditVC.roomObjectId = null;

};
///*Users Tab methods*/
trainingEventEditVC.onUsersTabClick = function ()
{
    //set button selected on click
    $('[data-toggle=trainings-contents-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=rooms-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=users-tab]').addClass('selected');

    //hide unneeded contents
    trainingEventEditVC.trainingsContent.hide();
    trainingEventEditVC.roomsContent.hide();
    trainingEventEditVC.usersContent.show();
};
trainingEventEditVC.listUsers = function ()
{
    var selectedUsers = arguments[0];
    var data = {};
    apiClient.post("/users/listUsers", data, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var usersArray = trainingEventEditVC.usersList = response.message;
        var $usersTableContent = $('.users-list__content');
        $usersTableContent.html("");
        //append without already selected users
        usersArray.forEach(function (user, index) {
            var userRow = $(trainingEventEditVC.usersListItemTpl);
                userRow.find('.users-list__item-name').text(user.name);
                userRow.find('.users-list__item-plus').attr('data-user-object-id', user.object_id);
                userRow.attr('user-object-id', user.object_id);
            //hide element in list if selected
            if(selectedUsers !='undefined' && selectedUsers !=null){
                selectedUsers.forEach(function (selectedUser, index) {
                    if (user.object_id == selectedUser.object_id)
                    {
                        userRow.css("display", "none");
                    }
                });
            }
            $usersTableContent.append(userRow);
        });
        //no rooms selected [empty] content
        var userListRows = trainingEventEditVC.userListRows;
        var usersDetails = trainingEventEditVC.usersContent.find('.content-table__col-details');
        //check previous choosing users
            if (typeof userListRows === 'undefined' || userListRows.length <= 0){
                usersDetails.html("");
                usersDetails.append("<div class='no-select-item'>No User Selected</div>");
            }

        //set events
        $('.users-list').find("[data-toggle=select-user]")
                .unbind("click")
                .click(trainingEventEditVC.onSelectUserClick);
    });
};
trainingEventEditVC.onUsersSearchKeyup = function ()
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

    var users = trainingEventEditVC.findUser(searchArray);

    users.forEach(function (user, index) {
        $roomsList.find('[user-object-id=' + user.object_id + ']').show();
    });
};
trainingEventEditVC.findUser = function (searchArray)
{
    var searchResult = [];
    searchResult = $.grep(trainingEventEditVC.usersList, function (e) {
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
trainingEventEditVC.onSelectUserClick = function ()
{
    var objectId = arguments[0];

    if (typeof objectId == 'string')
    {
        var userObjectId = objectId;
    }
    else {
        var userChoosen = $(this);
        var userObjectId = userChoosen.attr('data-user-object-id');
    }
    /*Append Details about the room */
    var data =
            {
                object_id: userObjectId
            };
    apiClient.post("/users/detailsUser", data, function (response) {

        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var userData = response.message;

        trainingEventEditVC.addUserToTable(userData[0]);

    });
    //hide selected user
    $('.users-list__item').each(function () {
        if ($(this).attr('user-object-id') == userObjectId) {
            $(this).hide();
        }
    });
};
trainingEventEditVC.addUserToTable = function (userData)
{
    //create array which will be appended
    var userListRows = trainingEventEditVC.userListRows;
                       trainingEventEditVC.userListRows.push(userData);

    //clean details table and append title
    var usersDetailsTable = trainingEventEditVC.usersContent.find('.content-table__col-details');
        usersDetailsTable.html("");
        usersDetailsTable.append("<div class='col-details__title'>Select Users</div>");
    //create row for each user form array 
    userListRows.forEach(function (item) {
        var userDetailContent = $(trainingEventEditVC.usersDetailsTpl);
            userDetailContent.find('.col-data-user__name').text(item.name);
            userDetailContent.find('.col-data-user__email').text(item.email);
            userDetailContent.find('.col-data-user__phone').text(item.username);
            userDetailContent.find('.icon-remove').attr('data-user-object-id', item.object_id);
            userDetailContent.attr('user-object-id', item.object_id);
            usersDetailsTable.append(userDetailContent);

    });
    //list users without selected
    trainingEventEditVC.listUsers(userListRows);
    //set events
    $("[data-function=users-table-details]").find("[data-toggle=remove-user]")
                                            .unbind("click")
                                            .click(trainingEventEditVC.onRemoveUserClick);
};
trainingEventEditVC.onRemoveUserClick = function ()
{
    var userObjectId = $(this).attr('data-user-object-id');
    //remove user from table
    $('.row-form').each(function () {
        if ($(this).attr('user-object-id') == userObjectId) {
            $(this).remove();
            //refresh List of Users
            trainingEventEditVC.refreshUserList(userObjectId);
        }
    });
    //remove training from global array
    var arrayAfterRemove = trainingEventEditVC.userListRows;
    $.each(arrayAfterRemove, function (i, el) {
        if (this.object_id == userObjectId) {
            arrayAfterRemove.splice(i, 1);
        }
    });
    var usersContent = trainingEventEditVC.usersContent.find('.row-form');
    //check is there any user in content
    if (usersContent.length <= 0)
    {
        var usersDetailsTable = trainingEventEditVC.usersContent.find('.content-table__col-details');
        usersDetailsTable.html("");
        usersDetailsTable.append("<div class='no-select-item'>No User Selected</div>");
        //clean "memory" array
        trainingEventEditVC.userListRows = [];

    }
};
trainingEventEditVC.refreshUserList = function (objectId)
{
    $('.users-list__item').each(function () {
        if ($(this).attr('user-object-id') == objectId) {
            $(this).show();
        }
    });
};
///*Trainings Contents Tab methods*/
trainingEventEditVC.onTrainingsContentsTabClick = function ()
{
    //set button selected on click
    $('[data-toggle=rooms-tab]').removeClass('selected').addClass('unclicked');
    $('[data-toggle=users-tab]').removeClass('selected').addClass('unclicked');
    ;
    $('[data-toggle=trainings-contents-tab]').addClass('selected');

    //hide unneeded contents
    trainingEventEditVC.usersContent.hide();
    trainingEventEditVC.roomsContent.hide();
    trainingEventEditVC.trainingsContent.show();
};
trainingEventEditVC.listTrainingsContents = function()
{   
    var selectedContents = arguments[0];
    var data = {};
    apiClient.post("/trainings/listTrainingsContents", data, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var trainingsContentsArray = trainingEventEditVC.trainingsList = response.message;

        var $trainingsTableContent = $('.trainings-list__content');
            $trainingsTableContent.html("");
        trainingsContentsArray.forEach(function(training, index){
            var trainingRow = $(trainingEventEditVC.trainingsListItemTpl);
                trainingRow.find('.trainings-list__item-name').text(training.name);
                trainingRow.find('.trainings-list__item-plus').attr('data-training-id',training.id);
                trainingRow.attr('training-id',training.id);
            if( selectedContents != 'undefined' && selectedContents != null){
                selectedContents.forEach(function (content, index) {
                    if (training.id == content.id)
                    {
                        trainingRow.css("display", "none");
                    }
                });
            }
            $trainingsTableContent.append(trainingRow);
        });
        
        //no rooms selected [empty] content
        var trainingListRows = trainingEventEditVC.trainingListRows;
        var trainingDetails = trainingEventEditVC.trainingsContent.find('.content-table__col-details');
        //check previous choosing users
        if (typeof trainingListRows === 'undefined' || trainingListRows.length <= 0){
            trainingDetails.html("");
            trainingDetails.append("<div class='no-select-item'>No Training Selected</div>");
        }
        //set events
        $('.trainings-list').find("[data-toggle=select-training]")
                            .unbind("click")
                            .click(trainingEventEditVC.onSelectTrainingClick);
    });
};
trainingEventEditVC.onTrainingsContentsSearchKeyup = function()
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

    var trainings = trainingEventEditVC.findTrainingContent(searchArray);

    trainings.forEach(function (training, index) {
        $trainingsList.find('[training-id=' + training.id + ']').show();
    });   
};
trainingEventEditVC.findTrainingContent = function(searchArray)
{
    var searchResult = [];
    searchResult = $.grep(trainingEventEditVC.trainingsList, function (e) {
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
trainingEventEditVC.onSelectTrainingClick = function()
{
    
    var selectedId = arguments[0];

    if (typeof selectedId == 'number')
    {
        var trainingId = selectedId;
    }
    else {
        var trainingChoosen = $(this);
        var trainingId = trainingChoosen.attr('data-training-id');
    }
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
        trainingEventEditVC.addTrainingToTable(trainingObject);

    });
    //hide selected training
    $('.trainings-list__item').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).hide();

        }
    }); 
};
trainingEventEditVC.addTrainingToTable = function(trainingObject)
{
    //create array which will be appended
    var trainingListRows = trainingEventEditVC.trainingListRows;
                           trainingEventEditVC.trainingListRows.push(trainingObject);
                                   
    //clean details table and append title
    var trainingsDetailsTable = trainingEventEditVC.trainingsContent.find('.content-table__col-details');
        trainingsDetailsTable.html("");
        trainingsDetailsTable.append("<div class='col-details__title'>Select Trainings</div>");
        
        //create row for each user form array 
        trainingListRows.forEach(function (item) {
            var trainingDetailContent = $(trainingEventEditVC.trainingsDetailsTpl);
                trainingDetailContent.find('.col-data-training__name').text(item.name);
                trainingDetailContent.find('.col-data-training__description').text(item.description);
                trainingDetailContent.find('.chapters-button').text("chapters : "+item.training_chapter_count);
                trainingDetailContent.find('.icon-remove').attr('data-training-id',item.id);
                trainingDetailContent.attr('training-id', item.id);
                trainingsDetailsTable.append(trainingDetailContent);
            });
    //list trainings without selected
    trainingEventEditVC.listTrainingsContents(trainingListRows);
    //set events
    $("[data-function=trainings-table-details]").find("[data-toggle=remove-training]")
                                                .unbind("click")
                                                .click(trainingEventEditVC.onRemoveTrainingClick);
                           
                           
};
trainingEventEditVC.onRemoveTrainingClick = function()
{
    var trainingId = $(this).attr('data-training-id');
    $('.row-form').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).remove();
            //refresh List of Trainings
            trainingEventEditVC.refreshTrainingList(trainingId);
        }
    });
    //remove training from global array
    var arrayAfterRemove = trainingEventEditVC.trainingListRows;
    $.each(arrayAfterRemove, function(i, el){
            if (this.id == trainingId){
                arrayAfterRemove.splice(i, 1);
        }
    });
    var trainingContent = trainingEventEditVC.trainingsContent.find('.row-form');
    //check is there any training in content
    if(trainingContent.length <= 0 )
    {
        var trainingsDetailsTable = trainingEventEditVC.trainingsContent.find('.content-table__col-details');
            trainingsDetailsTable.html("");
            trainingsDetailsTable.append("<div class='no-select-item'>No Training Selected</div>");
        //clean "memory" array
        trainingEventEditVC.trainingListRows = [];
    }

};
trainingEventEditVC.refreshTrainingList = function(trainingId)
{
    $('.trainings-list__item').each(function () {
        if ($(this).attr('training-id') == trainingId) {
            $(this).show();
        }
    });
};

trainingEventEditVC.onEditEventClick = function (loading)
{
    //Initialize variables
    var eventGroupId      = trainingEventEditVC.eventGroup;
    var eventName         = trainingEventEditVC.eventName;
    var eventStartAt      = trainingEventEditVC.startDate;
    var eventFinishAt     = trainingEventEditVC.finishDate;
    var trainingId        = trainingEventEditVC.id;
    var roomsObjectId     = trainingEventEditVC.roomObjectId;
    var users             = trainingEventEditVC.userListRows;
    var trainingsContents = trainingEventEditVC.trainingListRows;
    var usersObjectIds       = [];
    var trainingsContentsIds = [];

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
                'id'                   : trainingId,
                'trainings_groups__id' : eventGroupId,
                'name'                 : eventName,
                'rooms__object_id'     : roomsObjectId,
                'start_at'             : eventStartAt,
                'finish_at'            : eventFinishAt
            };
console.log("finish at", eventFinishAt);
    //prepare all data for request
    var dataParams =
            {
                create: [create],
                users__objects_ids: usersObjectIds,
                trainings_contents__ids: trainingsContentsIds
            };
            
    apiClient.post("/trainings/updateEvent", dataParams, function (response) {

        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }

        var modal = trainingEventEditVC.$modal;
            modal.modal('hide');

        var createdEvent = response.message;
    });
    $('[data-function=calendar-content]').find('.calendar__day-number').removeClass('calendar__day__selected');
    $('[data-function=calendar-content]').find('.calendar__day').find('[date='+eventStartAt.substr(0,10)+']').addClass('calendar__day__selected');
};
///*TEMPLATES*/
///*Rooms Templates*/
trainingEventEditVC.roomsListItemTpl = [
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

trainingEventEditVC.roomsDetailsTpl = [
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
    '<div id="description" class="data-text data-description"></div>',
    '</div>',
    '</div>',
    '</div>',
    '<div class="col-details__buttons">',
    '<button type="button" class="btn right remove-room" data-toggle="remove-select">Remove selected room</button>',
    '</div>'
].join("\n");

///*Users Templates*/
trainingEventEditVC.usersListItemTpl = [
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


trainingEventEditVC.usersDetailsTpl = [
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

///*Trainings Contents Templates*/

trainingEventEditVC.trainingsListItemTpl = [
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

trainingEventEditVC.trainingsDetailsTpl = [
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
