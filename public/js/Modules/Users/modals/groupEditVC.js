var groupEditVC = {};
groupEditVC.modal = $("[data-modal=group-edit]");
groupEditVC.contractData = null;

groupEditVC.initView = function (dataParam) {

    var $modal = groupEditVC.modal;
    tabView.object = $modal;
    tabView.showFirstTab();
    $modal.find(".menu").find(".icon")
            .unbind("click").click(tabView.changeModalContent);
    apiClient.post("/users/detailsUsersGroups", dataParam, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
        console.log('dataPARAM DETAILS');
        console.log(dataParam);
        
        var groupData = response.message;
        console.log(groupData.id);
        var $modal = groupEditVC.modal;
        
      
            if(typeof groupData.id != 'undefined')
            {
              $modal.modal("show");  
              $modal.find('input[name=groupId]').val(groupData.id);
              $modal.find("textarea[name=name]").val(groupData.name);
              $modal.find("textarea[name=description]").val(groupData.description);
            }

        //EDIT
        groupEditVC.modal.modal("show").find("[data-toggle=modal-edit-save]")
                .unbind("click").click(groupEditVC.onEditSaveClick);
        //DELETE       
        groupEditVC.modal.modal("show").find("[data-toggle=modal-edit-delete]")
                .unbind("click").click(groupEditVC.onEditDeleteClick);

    });
};

/*Edit-Save*/
groupEditVC.onEditSaveClick = function (e) {
    var $modal = groupEditVC.modal;


    console.log('onEditSaveClick');
    var groupId = $modal.find('input[name=groupId]').val();
    var dataParametrs = {
            id             :   groupId,    
            name           :   groupEditVC.modal.find("textarea[name=name]").val(),
            description    :   groupEditVC.modal.find("textarea[name=description]").val()
    };
    console.log(dataParametrs);
    var updateData =
            {
                "create": [dataParametrs]
            };
    console.log(updateData);
    apiClient.post("/users/updateUsersGroups", updateData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
//        refresh groups table - init again
        usersGroups.init();
        
        groupEditVC.modal.modal("hide");
        hideAlert();
    });
};
/*Edit-Delete*/
groupEditVC.onEditDeleteClick = function () {

    var groupId = usersGroups.$tableContent.find('.edit-group').attr("data-users_groups-id");
    var dataParam = {
        id : groupId
    };

    var deleteData =
            {
                "delete": [dataParam]
            };
    console.log(deleteData);
    apiClient.post("/users/deleteUsersGroups", deleteData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
       //refresh groups table - init again
        usersGroups.init();
        groupEditVC.modal.modal("hide");
        hideAlert();
        //remove unless cell with deleted group
        groupDeleted.forEach(function (group, index) {
            var groupCell = usersGroups.$tableContent.find("[data-users_groups-id=" + group.id + "]");
            groupCell.remove();
        });
    });
};


groupEditVC.initView();