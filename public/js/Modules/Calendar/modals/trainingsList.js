trainingsList = {};
trainingsList.$modal = $('[data-function=trainings-list]');
trainingsList.$modalFooter = $('[data-function=modal-footer]');
trainingsList.displayTrainingsDay = function (data){

    //modal content object
    var $modal = trainingsList.$modal;
    apiClient.post("/trainings/listTrainingsEventsContents", data, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }

        var trainings = response.message;

        //clean content
        $modal.find(".trainings-list").html("");
        // content
        $modal.find(".step1").css({marginLeft: "0px", opacity: 1, display: "block"});
        $modal.find(".step2").css({marginLeft: "1000px", opacity: 0});
        $modal.find(".step3").css({marginLeft: "1000px", opacity: 0,display:"none"});
        // footer
        $modal.find(".modal-footer .row").css({display: "none"});
        $modal.find(".modal-footer .list").css({display: "block"});


        var dataDate = (data.date);
        var localdate = new Date(dataDate);
        //add 1 to month
        var monthConverted = localdate.getMonth()+1;
        var dayConverted = localdate.getDate();
        //Months and days with two digits
        if(monthConverted<10){ monthConverted = '0' + monthConverted; };
        if(dayConverted<10)  {dayConverted    = '0' + dayConverted; };
        //Convert date to could append
        var dateConverted = localdate.getFullYear()
                            +'-'+monthConverted
                            +'-'+dayConverted;
        //Modal Title Date
        $modal.find("input[name=selectedDate]").val(dateConverted);
        $modal.find('.modal-header__date').text(dateConverted);

        //check if response > 0
        if (trainings.length > 0) {

            //hide "no trainings" string
            $modal.find(".no-trainings").hide();

            trainings.forEach(function (training) {
                trainingsList.displayAppendData(training);
            });

        } else {
            //there are no avaible trainings
             $modal.find(".no-trainings").show();
        }
        //show modal
        $modal.modal('show');
        $modal.find('.modal-dialog').css({left:0,top:0,overflow: "hidden"}).draggable({handle: '.modal-header'});
        //event
        trainingsList.$modalFooter.find('.list').find('.col-xs-2')
                              .unbind('click')
                              .click(trainingEventAddVC.initView);
    });
};
trainingsList.displayAppendData = function(training){

            var pivots = training.events_contents;

            var trainingTemplate = $('.content').find('.template').clone();
                trainingTemplate.removeClass("template");
                trainingTemplate.css({"display":"block"});
                trainingTemplate.attr('data-training-id',training.id);
                trainingTemplate.find('.icon-remove').attr("data-training-name",training.name);
                trainingTemplate.find('.icon-remove').attr("data-training-id",training.id);
                trainingTemplate.find('[data-toggle=edit-training]').attr("data-training-id",training.id);
                 /*Empty array of content names*/
            var tableOfContentsNames = [];
                pivots.forEach(function (pivot, index){

            var pivotContents = pivot.content;
            var trainingContentName = pivotContents.name;
                //push all contents into array
                tableOfContentsNames.push(pivotContents.name);

             });
                /* Array of names to string and
                 * show on traninng content */
                trainingTemplate.find(".training-item__name").text(training.name);
                if (tableOfContentsNames.length < 2){
                    trainingTemplate.find(".training-item__name-contents").text(tableOfContentsNames[0]);
                }
                else{trainingTemplate.find(".training-item__name-contents").text(tableOfContentsNames[0]+', '+
                                                                                 tableOfContentsNames[1]); }
                 ////TO DO !!!!!!   USERS
            //count of users
            if(typeof(training.training_user_count) !== "undefined" && training.training_user_count !== null){
                trainingTemplate.find(".training-item__users").text(training.training_user_count+"/"+training.seats_amount+" users");
            }
            else{trainingTemplate.find(".training-item__users").text("No users");}
                ////END TO DO!!!!! USERS
            //start_at of course
            var timeToCut = training.start_at;
                trainingTemplate.find(".training-item__time").text(timeToCut.substr(10,6));

            var groupId = training.trainings_groups__id;
            var addColor = trainingTemplate.find(".label-dot");
            //show color group
                if(groupId == 1){
                    addColor.addClass("dot-label--green");
                }
                if(groupId == 2){
                    addColor.addClass("dot-label--red");
                }
                if(groupId == 3){
                    addColor.addClass("dot-label--yellow");
                }
                if(groupId == 4){
                    addColor.addClass("dot-label--blue");
                }
                if(groupId == 5){
                    addColor.addClass("dot-label--gray");
                }
                if(groupId == 6){
                    addColor.addClass("dot-label--purpre");
                }
                 if(training.trainings_groups__id == 7){
                    addColor.addClass("dot-label--silver");
                }

   //modal content
   $modal  = trainingsList.$modal;
   //apend data
   $modal.find('.trainings-list').append(trainingTemplate);
   //events
    trainingsList.$modal.find('[data-toggle=edit-training]')
                 .unbind("click")
                 .click(trainingsList.onTrainingEventDblClick);
    $('.icon-remove').unbind("click")
                     .click(trainingsList.onRemoveIconClick);
};
trainingsList.onTrainingEventDblClick = function(){

    var trainingId = $(this).attr("data-training-id");
    var data = {id:trainingId};

    apiClient.post("/trainings/detailsTrainingEvent", data, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        var trainingEvent = response.message;

        //create new modal view with response data
        trainingEventEditVC.initView(trainingEvent);
        });
};
trainingsList.onRemoveIconClick = function(e)
{
    var trainingName = $(this).attr('data-training-name');
    var trainingId   = $(this).attr('data-training-id');
    $('.title').text("Training Event : "+ trainingName);
    $('.btn-ok', this).data('recordId', "data.recordId");
    //set button
    $('[data-toggle=delete-training]').attr("data-training-id",trainingId)
                                      .unbind("click")
                                      .click(trainingsList.onDeleteEventButtonClick);
    //appear loading content on delete click
    $('#confirm-delete').on('click', '.btn-ok', function (loading) {
        var $modalDiv = $(loading.delegateTarget);
        var id = $(this).data('recordId');
        $modalDiv.addClass('loading');
        setTimeout(function () {
            $modalDiv.modal('hide').removeClass('loading');
        }, 1000)
    });
};
trainingsList.onDeleteEventButtonClick = function(event)
{
    var trainingId = $(this).attr('data-training-id');
    var data = {id: trainingId};


    apiClient.post("/trainings/deleteEvent", data, function (response) {
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
    });
    var modal = trainingsList.$modal;
    modal.modal("hide");
};
