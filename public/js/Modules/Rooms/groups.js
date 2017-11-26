var groups = {};

/* Module params */
/*ROOMS*/
groups.roomGroupsList   = [];
groups.tableView        = $("[data-function=groups-list]");
groups.$tableContent    = $("[data-function=groups-list__content]");

/* Init view */
groups.init = function () {
    groups.setRoomsGroupsList();
};

/*ROOMS LIST*/
groups.setRoomsGroupsList = function () {
    var tableView = groups.tableView;
    var $tableContent = groups.$tableContent;
    // Clear view
        $tableContent.html("");
    // set All rooms
    var $allRoomsRow = $(groups.roomsTpl);
        $allRoomsRow.find(".groups-list__item-content").text("All Groups");
        
        // add events
        $allRoomsRow.click(groups.onRoomGroupClick);
        // append
        $tableContent.append($allRoomsRow);
        
    // Set rooms
    var dataParams = {};
    apiClient.post('/rooms/listRoomsGroups', dataParams, function (response) {
        if ("success" !== response.status) { showModal(response); return; }
        
        var roomsGroupsList = groups.roomGroupsList = response.message;
            
            // display all rooms
            roomsGroupsList.forEach(function (roomGroup, index) {
                //Append room item

                var $roomGroupRow = $(groups.roomsTpl);
                    // append data
                    $roomGroupRow.find(".groups-list__item-content").text(roomGroup.name);
                    $roomGroupRow.attr("data-rooms_groups-id", roomGroup.id);
                    // add events
                    $roomGroupRow.click(groups.onRoomGroupClick);
                    $roomGroupRow.dblclick(groups.onRoomGroupDoubleClick);
                // append row
                $tableContent.append($roomGroupRow);
            });
            
            // select first element on group list
            $tableContent.find('.groups-list__item').eq(0).trigger('click');
            
    });
};

groups.onRoomGroupClick = function(e) {
    groups.$tableContent.find('.groups-list__item').removeClass('groups-list__item--selected');
    var $group = $(this);
        $group.addClass('groups-list__item--selected');
    
    var dataPram = {
        rooms_groups__id   :   $group.attr('data-rooms_groups-id') 
    };
    roomsVC.getRoomsList(dataPram);
    
    e.stopPropagation();
};

groups.onRoomGroupDoubleClick = function(e)
{
    groups.$tableContent.find('.groups-list__item').removeClass('edit-group');
    var $group = $(this);
        $group.addClass('edit-group');
    var dataParam = {
        id : $group.attr('data-rooms_groups-id') 
    };
    roomGroupEditVC.initView(dataParam);
    e.stopPropagation();
};
    
groups.roomsTpl = [
    '<div class="groups-list__item">',
    '    <div class="groups-list__item-content">',
    '    </div>',
    '</div>',
].join("\n");
