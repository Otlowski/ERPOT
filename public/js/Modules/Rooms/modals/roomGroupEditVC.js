var roomGroupEditVC = {};
roomGroupEditVC.modal = $("[data-modal=room-group-edit]");
roomGroupEditVC.contractData = null;

roomGroupEditVC.initView = function (dataParam) {
    var $modal = roomGroupEditVC.modal;
    tabView.object = $modal;
    tabView.showFirstTab();
    $modal.find(".menu").find(".icon")
            .unbind("click").click(tabView.changeModalContent);

    apiClient.post("/rooms/detailsRoomsGroups", dataParam, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }

        var groupData = response.message;
        var $modal = roomGroupEditVC.modal;

        if (typeof groupData.id !== 'undefined')
        {
            $modal.find('input[name=groupId]').val(groupData.id);
            $modal.find("textarea[name=name]").val(groupData.name);
            $modal.find("textarea[name=description]").val(groupData.description);
        }

        //EDIT
        roomGroupEditVC.modal.find("[data-toggle=edit-save]")
                .unbind("click").click(roomGroupEditVC.onEditSaveClick);
        //DELETE       
        roomGroupEditVC.modal.find("[data-toggle=edit-delete]")
                .unbind("click").click(roomGroupEditVC.onEditDeleteClick);
        roomGroupEditVC.modal.modal("show");
    });
};

/*Edit-Save*/
roomGroupEditVC.onEditSaveClick = function (e) {
    var $modal = roomGroupEditVC.modal;
    var groupId = $modal.find('input[name=groupId]').val();

    var dataParametrs = {
        id: groupId,
        name: roomGroupEditVC.modal.find("textarea[name=name]").val(),
        description: roomGroupEditVC.modal.find("textarea[name=description]").val(),
    };
    var updateData =
            {
                "create": [dataParametrs]
            };
    apiClient.post("/rooms/updateRoomsGroups", updateData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
        var groupDataArray = response.message;
        var groupDataCreated = groupDataArray.created;

//        refresh groups table - init again
        groups.init();

        roomGroupEditVC.modal.modal("hide");
        hideAlert();
    });
};
/*Edit-Delete*/
roomGroupEditVC.onEditDeleteClick = function () {
    console.log('DELETE check dblclick');
    var groupId = groups.$tableContent.find('.edit-group').attr("data-rooms_groups-id");
    var dataParam = {
        id: groupId
    };
    var deleteData =
            {
                "delete": [dataParam]
            };
    apiClient.post("/rooms/deleteRoomsGroups", deleteData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
        var responseData = response.message;
        var groupDeleted = responseData.deleted;

        groupDeleted.forEach(function (group, index) {
            var groupCell = groups.$tableContent.find("[data-rooms_groups-id=" + group.id + "]");
            groupCell.remove();
        });
        roomGroupEditVC.modal.modal("hide");
    });
    
};


roomGroupEditVC.initView();