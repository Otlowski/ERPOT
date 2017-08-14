
var tabView = {};

    tabView.object = null;
            
    tabView.tabs = null;
    tabView.pages = null;

    tabView.setDefault = function() {
        
    };
    
    tabView.changeModalContent = function(e) {
        var selectedTabIndex =  $(this).attr('data-tab-index');
        var selectedTabName =   $(this).attr('data-content-name');
        var currentTabIndex =   $('div.modal:visible .menu .selected').attr('data-tab-index');
        var currentName =       $('div.modal:visible .menu .selected').attr('data-content-name');
       
        if(currentName !== selectedTabName) {
            // Change selected tab
            $('div.modal:visible .menu .icon').removeClass("selected");
            $(this).addClass("selected");
            // Change content
            tabView.changePage(currentTabIndex,selectedTabIndex);
        }
    };
    
    tabView.changePage = function(currId,selectId) {
        var direction = (currId > selectId) ? 'L':'R';
        $("div.modal:visible .step-content")
                .not(".step"+selectId)
                .not(".step"+currId)
                .hide();

        if(direction === 'L') {
            // move left
            $("div.modal:visible .step"+selectId).css({marginLeft: "-1000px", opacity: 0, display: "block"});
            $("div.modal:visible .step"+selectId).animate({marginLeft: "0px", opacity: 1}, 500);
            $("div.modal:visible .step"+currId).animate({marginLeft: "1000px", opacity: 0}, 500);
        } else {
            // move right
            $("div.modal:visible .step"+selectId).css({marginLeft: "1000px", opacity: 0, display: "block"});
            $("div.modal:visible .step"+selectId).animate({marginLeft: "0px", opacity: 1}, 500);
            $("div.modal:visible .step"+currId).animate({marginLeft: "-1000px", opacity: 0}, 500);
        }
    };
    
    tabView.showFirstTab = function() {
        tabView.object.find(".menu").find('.icon').removeClass("selected");
        tabView.object.find(".menu").find('.icon').first().addClass("selected");
        tabView.object.find("[data-function=tab-content]").hide().css({"opacity":"1","margin-left":"-1000px;"});
        tabView.object.find("[data-function=tab-content]").first().show().css({"opacity":"1","margin-left":"0px"});
    };
    
    /*
     * Example use
     */
    //$('#modal-week-approve .menu .icon').click(tabView.changeModalContent);