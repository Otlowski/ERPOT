var userEditVC = {};

userEditVC.onUserEditClick = function (e) {
    console.log('setEditUserFOrm');
    userEditVC.setEditUserForm();
};

userEditVC.setEditUserForm = function () {

    // set visible form
    $("[data-function=preview]").hide();
    $("[data-function=add-user-content]").hide();
    $("[data-function=edit-user-content]").show();

    // set footer buttons in form

    $('[data-toggle="edit-user"]').hide();
    $('[data-toggle="edit-save"]').show();
    $('[data-toggle="cancel-item"]').show();
    $('[data-toggle="add-save"]').hide();
    $('[data-toggle="delete-item"]').show();

    //set buttons in edit-user-content	

    $("[data-toggle=edit-save]")
            .unbind("click").click(userEditVC.onEditSaveUserClick);
    console.log('check set buttons content');
    $("[data-toggle=cancel-item]")
            .unbind("click").click(userEditVC.onCancelClick);
    $("[data-toggle=delete-item]")
            .unbind("click").click(userEditVC.onEditDeleteUserClick);

    var usersObjectId = $(".col-items-list-content").find(".selected");
    var dataParam = {
        object_id: usersObjectId.attr('data-user-object_id')
    };
    console.log(dataParam);
    apiClient.post("/users/detailsUser", dataParam, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }

        var userData = response.message;

        var $content = $("[data-function=edit-user-content]").find('.items-informations-content');
        //append response data from database to edit form
        userData.forEach(function (user, index) {
            $content.find(".data-name").text(user.name);
            $content.find(".data-username").text(user.username);
            $content.find('input[name=objectId]').val(user.object_id);
            $content.find('input[name=username]').val(user.username);
            $content.find('input[name=email]').val(user.email);
            $content.find('input[name=password]').val(user.password);
            $content.find('input[name=firstname]').val(user.firstname);
            $content.find('input[name=lastname]').val(user.lastname);
            $content.find('input[name=admin]').val(user.is_admin);
            $content.find('input[name=group]').val(user.users_groups__id);
            $content.find('input[name=status]').val(user.status);

        });

    });
};

userEditVC.onEditSaveUserClick = function (e) {
    console.log('salut');
    var $editContent = $("[data-function=edit-user-content]").find('.items-informations-content');
    ;
    var dataParam =
            {
                object_id: $editContent.find('input[name=objectId]').val(),
                email: $editContent.find('input[name=email]').val(),
//                password                : $editContent.find('input[name=password]').val(),
                new_password: $editContent.find('input[name=new_password]').val(),
                new_password_confirm: $editContent.find('input[name=new_password_confirm]').val(),
                firstname: $editContent.find('input[name=firstname]').val(),
                lastname: $editContent.find('input[name=lastname]').val(),
                is_admin: $editContent.find('input[name=admin]').val(),
                users_groups__id: $editContent.find('input[name=group]').val()
            };

    var createData =
            {
                create: [dataParam]
            };
    console.log(createData);
    apiClient.post("/users/updateUser", createData, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }
        userEditVC.onCancelClick();
        usersVC.getUsersList();

    });

};
userEditVC.onCancelClick = function () {
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
userEditVC.onEditDeleteUserClick = function () {
    var $userObjectId = usersVC.$tableContent.find(".selected").attr("data-user-object_id");

    var dataParam =
            {
                object_id: $userObjectId
            };
    console.log(dataParam);
    var deleteData =
            {
                delete: [dataParam]
            };

    apiClient.post("/users/deleteUser", deleteData, function (response) {
        if ("success" !== response.status) {
            showModal(response);
            return;
        }
        userEditVC.onCancelClick();
        usersVC.getUsersList();
    });

};