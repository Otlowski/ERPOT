var roomsVC = {};

/* Module params */
/*ROOMS*/
roomsVC.roomList = [];

roomsVC.$tableContent = $("[data-function=room-list]").find('.items-list__content');
/* Init view */
roomsVC.initView = function () {
      groups.init();
      roomAddVC.init();
};
/* Module helpers */

/*ROOMS LIST*/

roomsVC.getRoomsList = function (dataParams) {
    var dataParams = (typeof dataParams !== 'undefined') ? dataParams : {};

    apiClient.post('/rooms/listRooms', dataParams, function (response) {
        if ("success" !== response.status) { showModal(response); return; }
            
        var roomsList = roomsVC.roomList = response.message;
        var $tableContent = roomsVC.$tableContent;
            $tableContent.html("");
            
            roomsList.forEach(function (room, index) {
                //Append cotract item
                var $roomRow = roomsVC.createRoomItem(room);
                //append
                $tableContent.append($roomRow);
               
            });
            roomsVC.setFooter();
            //search field keyup
            $("[data-function=search]").unbind("keyup").keyup(roomsVC.onSearchKeyup);

    });

};

roomsVC.createRoomItem = function(room) {
    
    //Append room item
    var $roomRow = $(roomsVC.offerTpl);

        $roomRow.find(".room-item__col--number").find(".col__room-number").text(room.number);
        $roomRow.find(".room-item__col--location").find(".col__address1").text(room.location);
//        $roomRow.find(".room-item__col--location").find(".col__address2").text(room.location);
        $roomRow.find(".room-item__col--seats").find(".col__seats").text(room.free_seats_amount);
        $roomRow.find(".room-item__col--floor").find(".col__floor").text(room.floor);
        // attributes
        $roomRow.attr("data-room-object_id",room.object_id);   
        //events
        $roomRow.click(roomsVC.onRoomClick); 

    return $roomRow;
    
  };
  
roomsVC.onSearchKeyup = function () {
    
    var searchValue = $(this).val();
    roomsVC.searchRooms(searchValue);
    
};
roomsVC.searchRooms = function(search) {
        var $roomsList =  $("[data-function=room-list]");
        // validation
            search = typeof search !== 'undefined' ? search.toLowerCase() : '';
        // if empty search value
        if(search === '') {
            $roomsList.find(".component.tablecell").show();
            return;
        }
        
        var searchArray = search.split(' ');
        if(searchArray[searchArray.length - 1] === '') {
            delete searchArray[searchArray.length - 1];
        }

        $roomsList.find(".component.tablecell").hide();
//        
        var rooms = roomsVC.findRoom(searchArray);

            rooms.forEach(function(room,index){
                $roomsList.find('[data-room-object_id='+room.object_id+']').show();
                
            });
     };
roomsVC.findRoom = function (searchArray) {
    roomsVC.rooms = null;
    var searchResult = [];
    
    
    searchResult = $.grep(roomsVC.roomList, function (e) {
        var show = false;
        for (var i = 0, len = searchArray.length; i < len; i++) {
            if (e.object_id.toLowerCase().indexOf(searchArray[i]) !== -1) {
                show = true;
            }
        }
        return show;
    });

    return searchResult;
};
    

roomsVC.onRoomClick = function(e) {
        roomsVC.$tableContent.find('.tablecell').removeClass('selected');
            e.stopPropagation();
            var $room = $(this).addClass('selected');
            var roomObjectId = $(this).attr("data-room-object_id");
            var dataParam =
            {
                object_id : roomObjectId
            };
           roomDetailsVC.initView(dataParam);
           
    };
roomsVC.setFooter = function () {

    var itemsCount = roomsVC.$tableContent.find(".tablecell").length;

    var footer = $("[data-function=room-list]").find(".items-list__footer").find("div");
    footer.text("Number of rooms: " + itemsCount);
//    test

};
///* Templates */
roomsVC.offerTpl = [
    '<div class="component tablecell">',
    '   <div class="room-item">',
    '       <div class="room-item__row">',
    '           <div class="room-item__col room-item__col--5">',
    '               <div class="room-item__col-status">',
    '                   <div class="dot-label dot-label--green">',
    '                   </div>',
    '               </div>',
    '           </div>',
    '           <div class="room-item__col room-item__col--15">',
    '               <div class="room-item__col--number">',
    '                   <div class="col__room-number">',
    '                   </div>',
    '               </div>',
    '           </div>',
    '           <div class="room-item__col room-item__col--30">',
    '               <div class="room-item__col--location">',
    '                   <div class="col__address1">',
    '                   </div>',
//    '                   <div class="col__address2">',
//    '                   </div>',
    '               </div>',
    '           </div>',
    '           <div class="room-item__col room-item__col--20">',
    '               <div class="room-item__col--seats">',
    '                   <div class="col__seats">',
    '                   </div>',
    '               </div>',
    '           </div>',
    '           <div class="room-item__col room-item__col--30">',
    '               <div class="room-item__col--floor">',
    '                   <div class="col__floor">',
    '                   </div>',
    '               </div>',
    '           </div>',
    '       </div>',
    '   </div>',
    '</div>'
].join("\n");

// run init
roomsVC.initView();
    