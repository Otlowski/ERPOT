var trainingsListVC = {};

/* Module params */
/*Trainings*/
trainingsListVC.trainingsGroupsList = [];
trainingsListVC.trainingList = [];
trainingsListVC.tableView = $("[data-function=groups]");
trainingsListVC.$tableContent = $("[data-function=groups-list__groups]");
trainingsListVC.$tableTrainingsContents = $("[data-function=trainings-list]");
/* Init view */
trainingsListVC.init = function () {
    trainingsListVC.getGroups();
    //events
    $('[data-function=add-training]').unbind('click')
                                     .click(trainingsListVC.onTrainingAddClick);
};

/*Traininngs LIST*/
trainingsListVC.getGroups = function () {
    var dataParam = {
    };
    apiClient.post("/trainings/listTrainingsGroups", dataParam, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        // if success
        var groupsList = trainingsListVC.groupsList = response.message;
        trainingsListVC.$tableContent.html("");

        groupsList.forEach(function (group, index) {
            var $groupTpl = $(trainingsListVC.trainingsGroupsItemTpl);
            $groupTpl.find('.groups-list__item-text').text(group.name);
            $groupTpl.attr('id', group.id);
            $groupTpl.attr('data-training-group-id', group.id);
            //events
            trainingsListVC.$tableContent.append($groupTpl);

            $groupTpl.click(trainingsListVC.onTrainingGroupClick);
            // $groupTpl.find('.groups-list__item-label').find('.glyphicon').attr('data-toggle','modal').attr('data-target','#confirm-delete');
            $groupTpl.find('.groups-list__item-label').hover(
                function() {
                  $(this).css({"color": "red", "font-size": "13px"});
                  $( this ).find('.glyphicon')
                           .removeClass( "glyphicon-folder-open")
                           .addClass("glyphicon-trash")
                          //  .attr('data-toggle','modal')
                          //  .attr('data-target','#confirm-delete')
                           .unbind('click')
                           .click(trainingsListVC.onDeleteTrainingGroup);
                }, function() {
                  $(this).css({"color": "#465D6E", "font-size": "11px"});
                  $( this ).find('.glyphicon')
                           .removeClass("glyphicon-trash")
                           .addClass( "glyphicon-folder-open");
                });
            $groupTpl.find('.groups-list__item-text').editable('dblclick',function(e){

              var trainingGroupId = e.target.prevObject[0].id;
              var newGroupName    = e.value;


              var create = {
                'id'   : trainingGroupI
              };
              var dataParams = { create : [create] };
              trainingsListVC.updateTrainingGroupName(dataParams);

            });

        });

        trainingsListVC.tableView.find('[data-function=groups-list__all]')
                .find('.groups-list__item')
                .unbind('click')
                .click(trainingsListVC.onTrainingGroupClick)
                .trigger('click');
    });
};
/*ON GROUP CLICK*/
trainingsListVC.onTrainingGroupClick = function (e) {

    trainingsListVC.tableView.find('.groups-list__item').removeClass('groups-list__item--selected');
    trainingsListVC.$tableContent.find('.groups-list__item').removeClass('groups-list__item--selected');
    var $group = $(this);
    $group.addClass('groups-list__item--selected');

    var dataPram = {
        trainings_groups__id: $group.attr('data-training-group-id')
    };
    trainingsListVC.getTrainingsList(dataPram);

    e.stopPropagation();
};

trainingsListVC.getTrainingsList = function (dataParams) {
    var dataParam = (typeof dataParams !== 'undefined') ? dataParams : {};
    apiClient.post('/trainings/listTrainingsContents', dataParam, function (response) {
        if ("success" !== response.status) {
            showModal(response);
            return;
        }

        var trainingsList = trainingsListVC.trainingList = response.message;

        var $tableTrainingsContents = trainingsListVC.$tableTrainingsContents;
        $tableTrainingsContents.html("");

        trainingsList.forEach(function (training_content, index) {
            //Append training item
            var $trainingRow = trainingsListVC.createTrainingItem(training_content);
                $trainingRow.attr('data-training-id',training_content.id);
                $tableTrainingsContents.append($trainingRow);

        });
        //set footer
        trainingsListVC.setFooter();
        //search field keyup
        $("[data-function=search]").unbind("keyup").keyup(trainingsListVC.onSearchKeyup);
        trainingsListVC.$tableTrainingsContents
                        .find('.training_content-item')
                        .unbind("click")
                        .click(trainingsListVC.onTrainingClick);

    });
};

trainingsListVC.createTrainingItem = function (trainingContent) {
    var $trainingsTpl = $(trainingsListVC.trainingContentItemTpl);
    var $chapters = trainingContent.training_chapter;
    var countOfChapters = Object.keys($chapters).length;

    $trainingsTpl.find('.training_content-item__col-name--name').text(trainingContent.name);
    $trainingsTpl.find('.chapters-button').text('chapters :'+' '+countOfChapters);
    $trainingsTpl.attr('data-training-id', trainingContent.id);

    return $trainingsTpl;

};

trainingsListVC.updateTrainingGroupName = function(dataParams){

  apiClient.post('/trainings/updateTrainingsGroups', dataParams, function (response) {
      if ("success" !== response.status) {
          showModal(response);
          return;
      }
      var editedTrainingGroup = response.message;
  });
};

trainingsListVC.onDeleteTrainingGroup = function(e){

  e.stopPropagation();
  var trainingGroupItem = $(this);
  var groupItemId = trainingGroupItem.parents('.groups-list__item').eq(0).attr('id');
  var deleted = {
    'id'   : groupItemId
  };
  var dataParams = { delete : [deleted] };

  apiClient.post('/trainings/deleteTrainingsGroups', dataParams, function (response) {
      if ("success" !== response.status) {
          showModal(response);
          return;
      }
      var editedTrainingGroup = response.message;
  });

};
/*ON TRAINING CLICK*/
trainingsListVC.onTrainingClick = function(e) {

        trainingsListVC.$tableTrainingsContents.find('.training_content-item').removeClass("selected");
            var $clickedItem = $(this);
                $clickedItem.addClass("selected");
        var trainingId = $clickedItem.attr("data-training-id");
        var dataParam = {
            id  : trainingId
        };
        apiClient.post("/trainings/detailsTrainingContent",dataParam,function(response){
            // if error
            if("success" != response.status) { showAlert(response); return; }
            // if success
            var trainingData = response.message;
            trainingsPreviewVC.showTrainingsDetails (trainingData);
        });
};
/* Methods for creating new Training */
trainingsListVC.onTrainingAddClick = function(e) {
  trainingsListVC.createTrainingRow();
};
trainingsListVC.createTrainingRow = function(e){
  var lastTraining = $('.training_content-item').last();
  var newTrainingTemplate = $(trainingsListVC.newTrainingInput);
      newTrainingTemplate.addClass('new-training');
      newTrainingTemplate.find('#name-input').addClass('active-input');

      if(lastTraining){
        lastTraining.after(newTrainingTemplate);
      }else{
        $('.training_content__content').append(newTrainingTemplate);
      }

      //focus
      $('.active-input').focus();
      $(".active-input").keyup(function(event){
        var trainingName = $(this).val();
        if(event.keyCode === 13) trainingsListVC.confirmAddNewTraining(trainingName);
        if(event.keyCode === 27) trainingsListVC.cancelAddingNewTraining();
      });

      $('.active-input').on('focusout', function(e){
        var trainingName = $(this).val();

        if(trainingName){ trainingsListVC.confirmAddNewTraining(trainingName);   }
        else          { trainingsListVC.cancelAddingNewTraining();           }
      });
};
trainingsListVC.confirmAddNewTraining = function(trainingName){

  var create = {
    'name'   : trainingName
  };
  var dataParams = { create : [create] };

  apiClient.post("/trainings/addTrainingContent", dataParams, function (response) {
      // if error
      if ("success" != response.status) {
          showAlert(response);
          return;
      }
      var responseName = response.message.created[0].name;
      var responseId   = response.message.created[0].id;

      //show span
      $('.new-training').find('#name-span')
                        .text(responseName)
                        .fadeIn()
                        .parents('.training_content-item')
                        .attr('data-training-id', responseId);

      $('.training_content-item')
                        .removeClass('new-training');
      //remove unneeded input
      $('.active-input').remove();
      //refresh footer
      trainingsListVC.setFooter();
    });

};
trainingsListVC.cancelAddingNewTraining = function(e){
    $('.new-training').remove();
};
(function($){
  $.fn.outside = function(ename, cb){
      return this.each(function(){
          var $this = $(this),
              self = this;

          $(document).bind(ename, function tempo(e){
              if(e.target !== self && !$.contains(self, e.target)){
                  cb.apply(self, [e]);
                  if(!self.parentNode) $(document.body).unbind(ename, tempo);
              }
          });
      });
  };
}(jQuery));
trainingsListVC.setFooter = function () {

    var itemsCount = trainingsListVC.$tableTrainingsContents
            .find(".training_content-item")
            .length;
    var footer = $(".training_content__footer");

    footer.text("Number of trainings: " + itemsCount);

};

/*Search Training*/
trainingsListVC.onSearchKeyup = function () {

    var searchValue = $(this).val();
    trainingsListVC.searchTrainings(searchValue);

};

trainingsListVC.searchTrainings = function (search) {
    var $trainingsList = $("[data-function=trainings-list]");
    // validation
    search = typeof search !== 'undefined' ? search.toLowerCase() : '';

    // if empty search value
    if (search === '') {
        $trainingsList.find(".training_content-item").show();
        return;
    }

    var searchArray = search.split(' ');
    if (searchArray[searchArray.length - 1] === '') {
        delete searchArray[searchArray.length - 1];
    }

    $trainingsList.find(".training_content-item").hide();

    var trainings = trainingsListVC.findTraining(searchArray);
    trainings.forEach(function (training, index) {
        $trainingsList.find('[data-training-id=' + training.id + ']').show();
    });
};

trainingsListVC.findTraining = function (searchArray) {
    var searchResult = [];

    searchResult = $.grep(trainingsListVC.trainingList, function (e) {
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

/*Training Templates*/
trainingsListVC.trainingsGroupsItemTpl = [
    '<div class="groups-list__item">',
    '    <div class="groups-list__item-content">',
    '        <div class="groups-list__item-label">',
    '            <i class="glyphicon glyphicon-folder-open"></i> ',
    '        </div>',
    '        <div class="groups-list__item-text"> [group_name] </div>',
    '    </div>',
    '</div>'
].join("\n");

trainingsListVC.trainingContentItemTpl = [
    '<div class="training_content-item">',
    '    <div class="training_content-item__row">',
    '        <div class="training_content__col training_content__col-name">',
    '            <span id="name-span" class="training_content-item__col-name--name">[Name]</span> ',
    '        </div>',
    '    </div>',
    '    <div class="training_content-item__row right">',
        '     <div class="chapters-button"></div>',
        '</div>',
    '</div>'
].join("\n");

trainingsListVC.newTrainingInput = [
  '<div class="training_content-item">',
      '<div class="training_content-item__row">',
         '<div class="training_content__col training_content__col-name">',
            '<span id="name-span" class="training_content-item__col-name--name" style="display:none;"></span> ',
            '<input id="name-input" class="training_content-item__col-name--name"></input>',
         '</div>',
      '</div>',
      '<div class="training_content-item__row right">',
      '   <div class="chapters-button">chapters : 0</div>',
      '</div>',
  '</div>'
].join("\n");
trainingsListVC.init();
