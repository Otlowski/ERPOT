var roomAddVC = {};
    roomAddVC.$modal = $('#modal-room-add');
    roomAddVC.contractorId = null;
    roomAddVC.groupsList = [];   
    
    roomAddVC.init = function() {
         $("[data-toggle=add-room]").unbind("click")
                 .click(roomAddVC.onRoomAddClick);
         
    };
    
    roomAddVC.onRoomAddClick = function(e) {
        var $trigger = $(this);
        console.log('trigger'+this);
        roomAddVC.initView($trigger,e);
       
    };
    
    roomAddVC.initView = function($trigger,e) {
        var $button = $trigger;
        var $modal = roomAddVC.$modal;
        
            
            // get and add contractors to dropdown menu
            apiClient.post('/rooms/listRoomsGroups',{},function(response){
                var roomsGroupsList = response.message;
                    console.log(roomsGroupsList);
                    roomAddVC.groupsList = roomsGroupsList;
                // add contractors to dropdown menu
                var groupsList = $('[data-function=groups-list]').find('.dropdown-menu');
                    groupsList.css({"max-height":200,"overflow-y":"scroll"});
                    groupsList.html("");
                    roomsGroupsList.forEach(function(group,index){
                        var $groupItem = $('<li><a href="#">'+group.name+'</a></li>');
                            $groupItem.find('a').attr('data-group-id',group.id);
                            // events
                            $groupItem.click(roomAddVC.onGroupChange);
                        // append item
                        groupsList.append($groupItem);
                        
                    });
            });
            $modal.modal("show");
            // clear form
            $modal.find("input").val("");
            $modal.find("textarea").val("");
            $modal.find('[data-function=groups-list]').find('.groups-list__value').text(' ---- select group ---- ');
            $modal.find('[data-function=groups-list]').find('.groups-list__value').attr('data-group-id','');
            // add events
            $modal.find("[data-toggle=add-save]").unbind("click")
                    .click(roomAddVC.addRoom);
            
    };  
    
    roomAddVC.onGroupChange = function(e) {
        var $groupItem = $(this);
        var $groupsList = $(this).parents('.btn-group');
        
            $groupsList.find('.groups-list__value').text( $groupItem.find('a').text() );
            $groupsList.find('.groups-list__value').attr('data-group-id', $groupItem.find('a').attr('data-group-id') );
        
    };
    
    roomAddVC.addRoom = function(e) {
        var button = $(this);
        console.log('addRoom');
//            disableButton(button);
        var $modal = roomAddVC.$modal;
        var groupId = $modal.find('[data-function=groups-list]')
                                .find('.groups-list__value')
                                .attr('data-group-id');
        var dataParam = {
            rooms_groups__id      :   groupId, 
            number                :   $modal.find("input[name=roomNumber]").val(),
            floor                 :   $modal.find("input[name=floor]").val(),  
            free_seats_amount     :   $modal.find("input[name=freeSeats]").val(),
            address1              :   $modal.find("input[name=address1]").val(),
            address2              :   $modal.find("input[name=address2]").val(),
            description           :   $modal.find("textarea[name=description]").val(),
        };
        var sendData = 
                {
                    "create" : [dataParam]
                };
      
        console.log(sendData);
        apiClient.post("/rooms/addRoom",sendData,function(response){
            
            if('success' !== response.status) { showAlert(response); return; }
            console.log('responseeeee'+response);
            $modal.modal("hide");
            
            roomsVC.initView();
            
        });
        
    };
    