roomGroupAddVC = {};
roomGroupAddVC.$modal = $('#modal-room-group-add');
roomGroupAddVC.$groupContent =  $("[data-function=main-col__groups]");

roomGroupAddVC.initView = function()
{   console.log('welcome!!!');
    $("[data-toggle=add-room-group]").unbind("click").click(this.onRoomGroupAddClick);
};

roomGroupAddVC.onRoomGroupAddClick = function(e){
 roomGroupAddVC.setAddRoomGroupModal(); 
 console.log('clickccc');
 
};
roomGroupAddVC.setAddRoomGroupModal = function()
{
    console.log('clickccc');
    var $modal = roomGroupAddVC.$modal;
    $modal.modal("show");
    $("[data-toggle=add-save]")
                .unbind("click").click(roomGroupAddVC.onAddSaveRoomGroupClick);
};

roomGroupAddVC.onAddSaveRoomGroupClick = function(e)
{
    var dataForm = $(".modal-content");
    
    var dataParams = 
            {
                name        : dataForm.find("input[name=groupName]").val(),
                description : dataForm.find("textarea[name=description]").val()
            };
    var dataCreate   = 
           {
                       "create" : [dataParams]
           };
   apiClient.post("/rooms/addRoomsGroups",dataCreate,function(response){
           if("success" !== response.status) {
               showAlert(response);
               return;
           }
           groups.init();
           var $modal = roomGroupAddVC.$modal;
               $modal.modal("hide");
        });      
};

roomGroupAddVC.initView();
