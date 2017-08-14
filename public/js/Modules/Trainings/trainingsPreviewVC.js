var trainingsPreviewVC = {};

    trainingsPreviewVC.chaptersList = [];
    trainingsPreviewVC.$tableContent = $("[data-function=chapters-content]");
    trainingsPreviewVC.$alertForm = $("[data-function=alert-form]");
    trainingsPreviewVC.$previewForm = $("[data-function=preview-form]");
    trainingsPreviewVC.$chaptersContent = $("[data-function=chapters-content]");
    
    trainingsPreviewVC.trainingsData = {};
    trainingsPreviewVC.showTrainingsDetails = function (trainingData) {

        var $alertForm = trainingsPreviewVC.$alertForm;
            $alertForm.hide();
            
        var previewForm = trainingsPreviewVC.$previewForm;
            previewForm.show();
            console.log(trainingData);
            $("#data-name").text(trainingData.name);
            
            //Contents Chapters,Documents,Notes
        var trainingContentsId = trainingData.id;
            console.log(trainingContentsId);
        var dataParam ={ 
            trainings_contents__id : trainingContentsId
            };
        trainingsPreviewVC.createChaptersItems(dataParam);
        
        //set buttons
        // $('[data-toggle=chapters]').unbind("click")
        $('[data-toggle=chapters]') .unbind("click")
                                    .click(trainingsPreviewVC.onTrainingChaptersClick);
        $('[data-toggle=documents]').unbind("click")
                                    .click(trainingsPreviewVC.onDocumentsListClick);
        $('[data-toggle=notes]')    .unbind("click")
                                    .click(trainingsPreviewVC.onTrainingNotesClick);
    };
    
    trainingsPreviewVC.createChaptersItems = function(dataParam){
        apiClient.post("/trainings/listTrainingsChapters", dataParam, function (response) {
        // if error
        if ("success" != response.status) {
            showAlert(response);
            return;
        }
        // if success, clean content
        var chaptersList = trainingsPreviewVC.chaptersList = response.message;
        trainingsPreviewVC.$tableContent.html("");
        
        var actualChapter = 1;
        var mask = "00";
        chaptersList.forEach(function (chapter, index) {
            var $chapterTpl = $(trainingsPreviewVC.trainingsChapterItemTpl);
//            $chapterTpl.find('.data-text').text(chapter.value);
            $chapterTpl.find('.content-value').text(chapter.value);
            $chapterTpl.find('.chapter-item__name').text(chapter.name);
            $chapterTpl.find('.chapter-item__text').text(chapter.description);
            actualChapter++;
        //append
            trainingsPreviewVC.$tableContent.append($chapterTpl);

            });
        });
    };
    
    trainingsPreviewVC.onTrainingChaptersClick = function(){ 
        
        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");
        
        trainingsPreviewVC.$chaptersContent.show();
        
    };
    
    trainingsPreviewVC.onDocumentsListClick = function(){ 
        
        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");
        
        trainingsPreviewVC.$chaptersContent.hide();
    };
    
    trainingsPreviewVC.onTrainingNotesClick = function(){ 
        
        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");
        
        trainingsPreviewVC.$chaptersContent.hide();
    };
    
    trainingsPreviewVC.trainingsChapterItemTpl = [
        '<div class="chapter-item">',
        '    <div class="col-line">',
        '        <div class="line">',
        '        </div>',
        '    </div>',
        '</div>',
        '<div class="chapter-item">',
        '    <div class="chapter-item__number">',
        '          <div class="chapter-item__number-content">',
        '               <div class="content-value"></div>',
        '          </div>',
        '   </div>',
        '   <div class="chapter-item__name">',    
        '   </div>',
        '   <div class="chapter-item__text">',
        '   </div>',
        '   <div class="chapter-item__download">',
        '   </div>',
        '<div class="chapter-item">',
        '<div class="col-line"><div class="line"></div></div>',
        '</div>',
        '    <div class="col-data">',
        '        <div id="data-description" class="data-text">',
        '        </div>',
        '    </div>',
        '</div>'
    ].join("\n");
    