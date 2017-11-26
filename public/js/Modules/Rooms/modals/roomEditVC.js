var roomDetailsVC = {};
roomDetailsVC.modal = $("[data-modal=contract-edit]");
roomDetailsVC.contractData = null;
roomDetailsVC.initView = function (dataParam) {

    var $modal = roomDetailsVC.modal;
    tabView.object = $modal;
    tabView.showFirstTab();
    $modal.find(".menu").find(".icon")
            .unbind("click").click(tabView.changeModalContent);


    apiClient.post("/rooms/detailsRoom", dataParam, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }

        var roomData = response.message;
        var $modal = roomDetailsVC.modal;
        $modal.find('input[type=text]').val('');

        roomData.forEach(function (room, index) {
            
            $modal.find("input[name=roomObjectId]").val(room.object_id);
            
            $modal.find("[data=roomNumber]").text(room.number);  
            $modal.find("input[name=floor]").val(room.floor);
            $modal.find("input[name=freeSeats]").val(room.free_seats_amount);
            $modal.find("input[name=address1]").val(room.address1);
            $modal.find("input[name=address2]").val(room.address2);
            $modal.find("textarea[name=description]").val(room.description); 
           if(typeof(room.rooms_groups__id) !== 'undefined' && room.room_group !== null){
            $modal.find("input[name=roomGroupId]").val(room.rooms_groups__id);
            $modal.find("[data=roomGroupNumber]").text(room.room_group.name);
            }
            else{
            $modal.find("input[name=roomGroupId]").val('');
            $modal.find("[data=roomGroupNumber]").text('');
            }
                    
        });
        //events 

        //EDIT
        roomDetailsVC.modal.modal("show").find("[data-toggle=edit-save]")
                .unbind("click").click(roomDetailsVC.onEditSaveClick);
        //DELETE       
        roomDetailsVC.modal.modal("show").find("[data-toggle=edit-delete]")
                .unbind("click").click(roomDetailsVC.onEditDeleteClick);

    });
};

/*Edit Room*/
roomDetailsVC.onEditSaveClick = function (e) {
    var $modal = roomDetailsVC.modal;

    var roomObjectId = $modal.find('input[name=roomObjectId]').val();
    var roomGroupId = $modal.find('input[name=roomGroupId]').val();
    var dataParametrs = {
//            rooms_groups__id      :   roomGroupId,    
//            number                :   roomDetailsVC.modal.find("[data=roomNumber]").val(),
        object_id: roomObjectId,
        floor: roomDetailsVC.modal.find("input[name=floor]").val(),
        free_seats_amount: roomDetailsVC.modal.find("input[name=freeSeats]").val(),
        address1: roomDetailsVC.modal.find("input[name=address1]").val(),
        address2: roomDetailsVC.modal.find("input[name=address2]").val(),
        description: roomDetailsVC.modal.find("textarea[name=description]").val(),
    };

    var updateData =
            {
                "create": [dataParametrs]
            };
    apiClient.post("/rooms/updateRoom", updateData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
        var roomDataArray = response.message;
        var roomDataCreated = roomDataArray.created;

        roomDataCreated.forEach(function (roomItem, index) {
            var $roomItem = roomsVC.$tableContent.find('[data-room-object_id=' + roomItem.object_id + ']');

            // refresh data on main list of contracts
            var $roomRow = roomsVC.createRoomItem(roomItem);
            $roomItem.replaceWith($roomRow);
        });

        // hide modal and clean  
        roomsVC.setFooter();
//                hideAlert();
        roomDetailsVC.modal.modal("hide");


    });

};
roomDetailsVC.onEditDeleteClick = function () {

    var roomObjectId = roomsVC.$tableContent.find('.selected').attr("data-room-object_id");

    var dataParam = {
        object_id: roomObjectId
    };

    var deleteData =
            {
                "delete": [dataParam]
            };

    apiClient.post("/rooms/deleteRoom", deleteData, function (response) {
        if ("success" !== response.status) {
            showModal(response);
            return;
        }

        var responseData = response.message;
        var roomDeleted = responseData.deleted;
        roomDeleted.forEach(function (room, index) {
            var roomCell = roomsVC.$tableContent.find("[data-room-object_id=" + room.object_id + "]");
            roomCell.remove();
        });
        //set footer after remove tablecell
        roomsVC.setFooter();
        // hide modal
        roomDetailsVC.modal.modal("hide");
    });
};

