var usersVC = {};

/* Module params */
/*USERS*/
usersVC.userList = [];

usersVC.$tableContent = $("[data-function=users-list]").find('.col-items-list-content');
usersVC.$changeContent = $(".main-content");
/* Init view */
usersVC.initView = function () {
    usersGroups.init();
    console.log('---test--- groups init');
    // set buttons 

    /*Add User      [+]*/
    $("[data-toggle=add-user]").unbind("click").click(userAddVC.onUserAddClick);
    /*Edit User [+]*/
    $("[data-toggle=edit-user]").unbind("click").click(userEditVC.onUserEditClick);
};
/* Module helpers */

/*USERS LIST*/

usersVC.getUsersList = function (dataParams) {
    var dataParams = (typeof dataParams !== 'undefined') ? dataParams : {};

    apiClient.post('/users/listUsers', dataParams, function (response) {
        if ("success" !== response.status) {
            showModal(response);
            return;
        }

        var usersList = usersVC.userList = response.message;
        var $tableContent = usersVC.$tableContent;
        $tableContent.html("");

        usersList.forEach(function (user, index) {
            //Append user item
            var $userRow = usersVC.createUserItem(user);
            //append
            $tableContent.append($userRow);

        });
        $("[data-function=search]").unbind("keyup").keyup(usersVC.onSearchKeyup);
        // select first element on users list
        $tableContent.find('.col-items-list-list').eq(0).trigger('click');
    });

};

usersVC.createUserItem = function (user) {

    //Append user item
    var $roomRow = $(usersVC.offerTpl);

    $roomRow.find(".col-items-list-list__item").find(".col-items-list-list__item-name").find("b").text(user.firstname+' '+user.lastname);
    // attributes
    $roomRow.attr("data-user-object_id", user.object_id);
    //events
    $roomRow.unbind("click").click(usersVC.onUserClick);

    return $roomRow;

};

usersVC.onUserClick = function (e) {
    usersVC.$tableContent.find(".col-items-list-list").removeClass("selected");
    var $user = $(this);
    $user.addClass("selected");

    var dataParam =
            {
                object_id: $user.attr("data-user-object_id")
            };
    console.log('click onUserClick');
    userDetailsVC.initView(dataParam);

};

/*Search User*/
usersVC.onSearchKeyup = function () {

    var searchValue = $(this).val();
    usersVC.searchUsers(searchValue);

};

usersVC.searchUsers = function (search) {
    var $usersList = $("[data-function=users-list]");
    // validation
    search = typeof search !== 'undefined' ? search.toLowerCase() : '';

    // if empty search value
    if (search === '') {
        $usersList.find(".col-items-list-list").show();
        return;
    }

    var searchArray = search.split(' ');
    if (searchArray[searchArray.length - 1] === '') {
        delete searchArray[searchArray.length - 1];
    }

    $usersList.find(".col-items-list-list").hide();

    var users = usersVC.findUser(searchArray);
    users.forEach(function (user, index) {
        $usersList.find('[data-user-object_id=' + user.object_id + ']').show();
    });
};

usersVC.findUser = function (searchArray) {
    var searchResult = [];

    searchResult = $.grep(usersVC.userList, function (e) {
        var show = false;
        for (var i = 0, len = searchArray.length; i < len; i++) {
            if (e.name.toLowerCase().indexOf(searchArray[i]) !== -1) {
                show = true;
            }
        }
        return show;
    });
    return searchResult;
};
/////* Templates */
usersVC.offerTpl = [
    '   <div class="col-items-list-list">',
    '       <div class="col-items-list-list__item">',
    '           <div class="col-items-list-list__item-name">',
    '                <b>',
    '                </b>',
    '           </div>',
    '       </div>',
    '   </div>',
].join("\n");

// run init
usersVC.initView();
    