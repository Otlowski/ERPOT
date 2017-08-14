trainingsGroupAddVC = {};
trainingsGroupAddVC.$modal = $('#modal-training-add');

trainingsGroupAddVC.initView = function(){
    $('[data-function=add-group]').unbind("click")
                                  .click(trainingsGroupAddVC.onTrainingGroupAddClick);
};

trainingsGroupAddVC.onTrainingGroupAddClick = function(){
    trainingsGroupAddVC.setAddTrainingGroupModal(); 
};

trainingsGroupAddVC.setAddTrainingGroupModal= function(){
    var $modal = trainingsGroupAddVC.$modal;
        $modal.modal("show");
        $("[data-toggle=add-save]")
                .unbind("click")
                .click(trainingsGroupAddVC.onAddSaveTrainingGroupClick);
};

trainingsGroupAddVC.onAddSaveTrainingGroupClick = function(){
    
    var dataForm = $(".modal-content");
    
    var dataParams = 
        {
            name        : dataForm.find("input[name=name]").val(),
            description : dataForm.find("textarea[name=description]").val()
        };
   var dataCreate   = 
        {
            "create" : [dataParams]
        };
        
   apiClient.post("/trainings/addTrainingsGroups",dataCreate,function(response){
            if("success" !== response.status) {
               showAlert(response);
               return;
            }
            trainingsListVC.init();
            var $modal = trainingsGroupAddVC.$modal;
                $modal.modal("hide");
        });      
};
trainingsGroupAddVC.initView();