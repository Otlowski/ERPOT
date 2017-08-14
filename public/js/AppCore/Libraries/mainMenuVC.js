var mainMenuVC = {};
    mainMenuVC.openMode = false;
    mainMenuVC.$menu = $('[data-function=main-menu]');
    
    mainMenuVC.initView = function() {
        
        $('[data-toggle=main-menu]').unbind('click')
                .click(mainMenuVC.onMainMenuToggleClick);
        
    };
    
    mainMenuVC.onMainMenuToggleClick = function(e) {
        
        switch(mainMenuVC.openMode) {
            case true:
                mainMenuVC.hideMenu();
                break
            case false:
                mainMenuVC.showMenu();
                break;
        }
        
    };
    
    
    mainMenuVC.showMenu = function() {
        var $menu = mainMenuVC.$menu;
        var $overlay = $('<div class="main-menu__overlay"></div>');
            $overlay.click(mainMenuVC.hideMenu);
            $('body').append($overlay);
            
            $menu.animate({
                    left: '-50px'
                },
                600, 
                'easeInOutQuart'
            );
            mainMenuVC.openMode = true;
    
    };
    mainMenuVC.hideMenu = function() {
        var $menu = mainMenuVC.$menu;
            $menu.animate({
                    left: '-350px'
                },
                300, 
                'swing'
            );
            $('body').find('.main-menu__overlay').remove();
            mainMenuVC.openMode = false;
    };
    
    
$(document).ready(function(){
    console.info("[init] Main Menu VC");
    mainMenuVC.initView();
    
});