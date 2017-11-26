var trainingsPreviewVC = {};

    trainingsPreviewVC.chaptersList = [];
    trainingsPreviewVC.$tableContent      = $("[data-function=chapters-content]");
    trainingsPreviewVC.$alertForm         = $("[data-function=alert-form]");
    trainingsPreviewVC.$previewForm       = $("[data-function=preview-form]");
    trainingsPreviewVC.$chaptersContent   = $("[data-function=chapters-content]");
    trainingsPreviewVC.$playChapterButton = $("[data-function=play-chapter]");
    trainingsPreviewVC.$documentsList     = $("[data-function=documents-content]");
    trainingsPreviewVC.$notesList         = $("[data-function=notes-content]");
    trainingsPreviewVC.trainingContentId  = 0;

    trainingsPreviewVC.trainingsData = {};
    trainingsPreviewVC.showTrainingsDetails = function (trainingData) {

        var $alertForm = trainingsPreviewVC.$alertForm;
            $alertForm.hide();

        var previewForm = trainingsPreviewVC.$previewForm;
            previewForm.show();
            $("#data-name").text(trainingData.name);

            //Contents Chapters,Documents,Notes
        var trainingContentsId = trainingsPreviewVC.trainingContentId = trainingData.id;

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
                            
        /*Clean forms*/
        var documentsTable = $('#documents-table');
            documentsTable.html('');
        var notesListContent = $('[data-function=notes-content]').find('.cards');
            notesListContent.html('');
        
        $('[data-toggle=chapters]').trigger('click');
    };
    /*Trainings Chapters - methods*/
    trainingsPreviewVC.onTrainingChaptersClick = function(){

        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");

        trainingsPreviewVC.$chaptersContent.show();
        trainingsPreviewVC.$notesList.hide();
        trainingsPreviewVC.$documentsList.hide();
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
            $chapterTpl.find('.chapter-item__play').attr('data-training-chapter-id',chapter.id)
                                                   .attr('data-toggle','collapse')
                                                   .attr('data-target','#chapter-video-'+chapter.id)
                                                  .unbind("click")
                                                  .click(trainingsPreviewVC.onTrainingChapterVideoClick);
            $chapterTpl.find('.collapse').attr("id","#chapter-video-"+chapter.id)
            $chapterTpl.find('.content-value').text(chapter.value);
            $chapterTpl.find('.chapter-item__name').text(chapter.name);
            $chapterTpl.find('.chapter-item__text').text(chapter.description);
            actualChapter++;
        //append
            trainingsPreviewVC.$tableContent.append($chapterTpl);

            });
        });
    };
    trainingsPreviewVC.onTrainingChapterVideoClick = function(){
        var trainingChapterId = $(this).attr("data-training-chapter-id");
        var parrentObject     = $(this).parent();
        var chapterVideoContent  = parrentObject.find('.collapse');
            chapterVideoContent.slideToggle(500, function(){

            });
    };
    /*Trainings Documents methods*/
    trainingsPreviewVC.onDocumentsListClick = function(){

        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");

        trainingsPreviewVC.$chaptersContent.hide();
        trainingsPreviewVC.$notesList.hide();
        trainingsPreviewVC.$documentsList.show();    

        trainingsPreviewVC.getDocumentsList();
    };
    trainingsPreviewVC.getDocumentsList = function(){
      
      var dataParams =
              {
                  'trainings_contents__id': trainingsPreviewVC.trainingContentId,
              };

      apiClient.post("/trainings/listTrainingsDocuments", dataParams, function (response) {
      // if error
      if ("success" != response.status) {
          showAlert(response);
          return;
      }
      // if success, clean content
      var documentsList = trainingsPreviewVC.documentsList = response.message;

      trainingsPreviewVC.appendDocuments(documentsList);
      });

    };
    trainingsPreviewVC.appendDocuments = function(documentsList){
      var documentsTable = $('#documents-table');
          documentsTable.html('');

      documentsList.forEach(function(el){
        var tableRow  = $(trainingsPreviewVC.documentTableRowTpl);
            tableRow.find('#name').text(el.name);
            tableRow.find('#description').text(el.description);
            tableRow.find('#created_at').text(el.created_at);

            tableRow.find('.download-button').on('click', function(e){
              downloader.downloadFile('/download/'+el.name);
            });

            documentsTable.append(tableRow);
      });


    };
    /*Trainings Notes methods*/
    trainingsPreviewVC.onTrainingNotesClick = function(){

        $('[data-toggle=notes]').removeClass("selected");
        $('[data-toggle=documents]').removeClass("selected");
        $('[data-toggle=chapters]').removeClass("selected");
        clicked = $(this);
        clicked.addClass("selected");
        
        trainingsPreviewVC.$documentsList.hide();
        trainingsPreviewVC.$chaptersContent.hide();
        trainingsPreviewVC.$notesList.show();
        trainingsPreviewVC.getNotesList();
         
         
    };
    trainingsPreviewVC.getNotesList =  function(){
        
        
        var trainingsContentId = trainingsPreviewVC.trainingContentId;
        
        var dataParam = {
            'trainings_contents__id' : trainingsContentId
        };
        
        apiClient.post("/trainings/listTrainingsNotes", dataParam, function (response) {
            
            // if error
            if ("success" != response.status) {
                showAlert(response);
                return;
            }
            // if success, clean content
            var notesList = response.message;
            //append notes
            trainingsPreviewVC.appendTrainingsNotes(notesList);
            //start animation
            trainingsPreviewVC.notesAnimation();
           
      });
      
        
 
    };
    trainingsPreviewVC.appendTrainingsNotes = function(notesList){
        var notesListContent = $('[data-function=notes-content]').find('.cards');
            notesListContent.html('');
        
            notesList.forEach(function(el){
                var noteCardTemplate = $(trainingsPreviewVC.trainingCardTpl);
                    noteCardTemplate.find("#author").text(el.author);
                    noteCardTemplate.find("#created_at").text(el.created_at);
                    noteCardTemplate.find("#note").text(el.note);
                    
                    notesListContent.append(noteCardTemplate);
            });
        
    };
    trainingsPreviewVC.notesAnimation = function(){
        $.fn.commentCards = function(){

            return this.each(function(){

              var $this = $(this),
                  $cards = $this.find('.card'),
                  $current = $cards.filter('.card--current'),
                  $next;

              $cards.on('click',function(){
                if ( !$current.is(this) ) {
                  $cards.removeClass('card--current card--out card--next');
                  $current.addClass('card--out');
                  $current = $(this).addClass('card--current');
                  $next = $current.next();
                  $next = $next.length ? $next : $cards.first();
                  $next.addClass('card--next');
                }
              });

              if ( !$current.length ) {
                $current = $cards.last();
                $cards.first().trigger('click');
              }

              $this.addClass('cards--active');

            });

          };

            $('.cards').commentCards();
    };
    /*Templates*/
    trainingsPreviewVC.trainingCardTpl = [
        '<li class="card">',
        '   <h1 id="author"></h1>',
        '   <p id="created_at"></p>',
        '   <p id="note">Lorem ipsum dolor ibendulast rhoncornaque.</p>',
        '</li>'
    ].join("\n");        
    
    trainingsPreviewVC.documentTableRowTpl = [
      '<tr>',
      '    <td id="name"></td>',
      '    <td id="description"></td>',
      '    <td id="download"><a class="download-button"><button type="button" class="btn-download btn btn-primary">Download</button></a></td>',
      '    <td id="created_at"></td>',
      '</tr>'
    ].join("\n");
    trainingsPreviewVC.trainingsChapterItemTpl = [
        '<div class="container">',
        '<div class="chapter-item">',
        '   <div class="chapter-item__number">',
        '          <div class="chapter-item__number-content">',
        '               <div class="content-value"></div>',
        '          </div>',
        '   </div>',
        '   <div class="chapter-item__name">',
        '   </div>',
        '   <div class="chapter-item__text">',
        '   </div>',
        '   <div class="chapter-item__media-box">',
        // '     <div class="chapter-item__download">',
        // '     </div>',
        '     <img class="chapter-item__play" src="../../../static/img/Trainings/play_chapter.png" alt="">',
        '     <div class="chapter-item__viedeo-content collapse">',
        '       <video width="600" style="display:block; margin:0 auto;" poster="../../../static/img/App/erpot-logo.png" controls>',
        '         <source src="../../../static/videos/trainings-chapters/20160207_140442.mp4" type="video/mp4">',
        '         <source src="../../../static/videos/trainings-chapters/20160207_140442.mp4" type="video/ogg">',
        '         <p>Your browser doesnt support HTML5 video. Here is a <a href="rabbit320.mp4">link to the video</a> instead.</p>',
        '       </video>',
        '     </div>',
        '   </div>',
        '</div>',
        '</div>'
    ].join("\n");
