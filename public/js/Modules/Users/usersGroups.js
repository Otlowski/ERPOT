var usersGroups = {};

/* Module params */
/*USERSS*/
usersGroups.userGroupsList   = [];
usersGroups.tableView        = $("[data-function=col-groups]");
usersGroups.$tableContent    = $("[data-function=col-groups-content]");

/* Init view */
usersGroups.init = function () {
    usersGroups.setUsersGroupsList();
};

/*USERS LIST*/
usersGroups.setUsersGroupsList = function () {
    var tableView = usersGroups.tableView;
    var $tableContent = usersGroups.$tableContent;
    // Clear view
        $tableContent.html("");
    // set All users
    var $allUsersRow = $(usersGroups.usersTpl);
        $allUsersRow.find(".col-groups-list__item-content").text("All Groups");
        
        // add events
        $allUsersRow.click(usersGroups.onUserGroupClick);
       
        // append
        $tableContent.append($allUsersRow);
        
    // Set rooms
    var dataParams = {};
    apiClient.post('/users/listUsersGroups', dataParams, function (response) {
        if ("success" !== response.status) { showModal(response); return; }
        
        var usersGroupsList = usersGroups.userGroupsList = response.message;
        console.log(usersGroupsList);
            
            // display all rooms
            usersGroupsList.forEach(function (userGroup, index) {
                //Append room item

                var $userGroupRow = $(usersGroups.usersTpl);
                    // append data
                    $userGroupRow.find(".col-groups-list__item-content").text(userGroup.name);
                    $userGroupRow.attr("data-users_groups-id", userGroup.id);
                    // add events
                    $userGroupRow.click(usersGroups.onUserGroupClick);
                    $userGroupRow.dblclick(usersGroups.onUserGroupDoubleClick);
                // append row
                $tableContent.append($userGroupRow);
            });
            
            // select first element on group list
            $tableContent.find('.col-groups-list__item').eq(0).trigger('click');
            
    });
};

usersGroups.onUserGroupClick = function(e) {
    usersGroups.$tableContent.find('.col-groups-list__item').removeClass('col-groups-list__item--selected');
    var $group = $(this);
        $group.addClass('col-groups-list__item--selected');
    
    var dataPram = {
        users_groups__id   :   $group.attr('data-users_groups-id') 
    };
    usersVC.getUsersList(dataPram);
    
    e.stopPropagation();
};
usersGroups.onUserGroupDoubleClick = function(e)
{
    usersGroups.$tableContent.find('.col-groups-list__item').removeClass('edit-group');
    var $group = $(this);
        $group.addClass('edit-group');
    var dataParam = {
        id : $group.attr('data-users_groups-id') 
    };
    groupEditVC.initView(dataParam);
    e.stopPropagation();
};
    
usersGroups.usersTpl = [
    '<div class="col-groups-list__item">',
    '    <div class="col-groups-list__item-content">',
    '    </div>',
    '</div>',
].join("\n");
