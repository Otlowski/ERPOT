var userDetailsVC = {};

userDetailsVC.userContent = $("[data-function=preview]").find('.items-informations-content');
userDetailsVC.userEditContent = $("[data-function=main-footer]");

userDetailsVC.initView = function (dataParam) {

    apiClient.post("/users/detailsUser", dataParam, function (response) {
        if ("success" !== response.status) {
            showAlert(response);
            return;
        }

        var userData = response.message;
        console.log(userData);

        var $content = userDetailsVC.userContent;
        
        
    console.log('[INFO] Show add user form');
        // set visible form
        $("[data-function=preview]").show();
        $("[data-function=add-user-content]").hide();
        $("[data-function=edit-user-content]").hide();
        //set visible buttons in form
        $('[data-toggle="edit-user"]').show();
        $('[data-toggle="edit-save"]').hide();
        $('[data-toggle="cancel-item"]').hide();
        $('[data-toggle="add-save"]').hide();
        $('[data-toggle="delete-item"]').hide();
        // set user data i preview form
        // userData[0]
        userData.forEach(function (user, index) {
            $content.find(".data-table").find(".data-name").text(user.firstname+' '+user.lastname);
            $content.find(".data-table").find(".data-username").text(user.username);
            $content.find(".col-data").find("#firstname").text(user.firstname);
            $content.find(".col-data").find("#lastname").text(user.lastname);
            $content.find(".col-data").find("#email").text(user.email);
            $content.find(".col-data").find("#status").text(user.status);
            $content.find(".col-data").find("#created_at").text(user.created_at);
            $content.find(".col-data").find("#last_update").text(user.updated_at);
            
        });
        //set buttons - user details and permissions
        $("[data-toggle=details]")
                .unbind("click").click(userDetailsVC.onUserDetailsClick);
        $("[data-toggle=permissions]")
                .unbind("click").click(userDetailsVC.onPermissionsClick);
    });
};
userDetailsVC.onUserDetailsClick  = function(e) 
{
    console.log('CLICK userDetails');
    var $userContent = userDetailsVC.userContent;
    $userContent.find(".btn-group").find('[data-toggle="permissions"]').removeClass("selected");
    $userContent.find(".btn-group").find('[data-toggle="details"]').removeClass("selected");
    $(this).addClass("selected");
    //set visible form
    $("[data-function=userDetails]").show();
};
userDetailsVC.onPermissionsClick  = function(e) 
{   
    var $userContent = userDetailsVC.userContent;
    $userContent.find(".btn-group").find('[data-toggle="details"]').removeClass("selected");
    $userContent.find(".btn-group").find('[data-toggle="permissions"]').removeClass("selected");
    $(this).addClass("selected");
    //set visible form
    $("[data-function=userDetails]").hide();
};



