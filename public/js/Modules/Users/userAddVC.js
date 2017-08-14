var userAddVC = {};

userAddVC.onUserAddClick = function (e) {
    console.log('onUserAddClick');
    userAddVC.setAddUserForm();

};
userAddVC.setAddUserForm = function () {
    console.log('[INFO] Show add user form');
    // set visible form
    $("[data-function=preview]").hide();
    $("[data-function=add-user-content]").show();
    $("[data-function=edit-user-content]").hide();

    // set user data in form

    // set button actions
    // delete button

    // set footer buttons in form

    $('[data-toggle="edit-user"]').hide();
    $('[data-toggle="edit-save"]').hide();
    $('[data-toggle="cancel-item"]').show();
    $('[data-toggle="add-save"]').show();
    
    //set buttons in add-user-content	

    $("[data-toggle=add-save]")
            .unbind("click").click(userAddVC.onAddSaveUserClick);
    console.log('check set buttons content');
    $("[data-toggle=cancel-item]")
            .unbind("click").click(userAddVC.onCancelClick);
};

userAddVC.onAddSaveUserClick = function (e) {

    console.log('onAddSaveUserClick');
    var dataForm = $("[data-function=add-user-content]");
    
    var dataParams =
            {
                name             : dataForm.find("input[name=fullname]").val(),
                username         : dataForm.find("input[name=username]").val(),
                email            : dataForm.find("input[name=email]").val(),
                password         : dataForm.find("input[name=password]").val(),
                password_confirm : dataForm.find("input[name=confirmPassword]").val(),
                firstname        : dataForm.find("input[name=firstname]").val(),
                lastname         : dataForm.find("input[name=lastname]").val(),
                is_admin         : dataForm.find("input[name=admin]").val(),
                users_groups__id : dataForm.find("input[name=group]").val(),
//                status          : dataForm.find("input[name=status]").val()
//                status          :  $('#input-status').change(function(){$(this).val();})
            };


    var dataCreate =
            {
                "create": [dataParams]
            };
;
    apiClient.post("/users/addUser", dataCreate, function (response) {
           if("success" !== response.status) {		
            var userData = response.message;
            showModal(response);
         }    		
          usersVC.initView();
          usersVC.getUsersList();
    });
    
};

userAddVC.onCancelClick = function () {
    console.log('onCancelClick');
    //    set visible form
    $("[data-function=preview]").show();
    $("[data-function=add-user-content]").hide();
    $("[data-function=edit-user-content]").hide();
    // set footer buttons in form

    $('[data-toggle="edit-user"]').show();
    $('[data-toggle="edit-save"]').hide();
    $('[data-toggle="cancel-item"]').hide();
    $('[data-toggle="add-save"]').hide();
};
