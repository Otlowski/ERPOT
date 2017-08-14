groupAddVC = {};
groupAddVC.$modal = $('#modal-group-add');
groupAddVC.$groupContent =  $("[data-function=col-groups]");

groupAddVC.initView = function()
{
    $("[data-toggle=add-user-group]").unbind("click").click(this.onUserGroupAddClick);
};

groupAddVC.onUserGroupAddClick = function(e){
 groupAddVC.setAddGroupModal(); 
 console.log('clickccc');
 
};
groupAddVC.setAddGroupModal = function()
{
    console.log('clickccc');
    var $modal = groupAddVC.$modal;
    $modal.modal("show");
    $("[data-toggle=modal-add-save]")
                .unbind("click").click(groupAddVC.onAddSaveUserGroupClick);
};

groupAddVC.onAddSaveUserGroupClick = function(e)
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
   apiClient.post("/users/addUsersGroups",dataCreate,function(response){
           if("success" !== response.status) {
              showAlert(response); 
              return;
            }
           usersGroups.init();
           var $modal = groupAddVC.$modal;
            $modal.modal("hide");
        });    
};

groupAddVC.initView();
