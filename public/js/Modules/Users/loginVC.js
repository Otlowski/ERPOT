/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var loginVC             = {};
    loginVC.$boxLogin   = $("[data-function=box-login]");
    loginVC.$btnLogin   = $("[data-function=button-login]");
    

    loginVC.initView = function() {
        var $btnLogin =  loginVC.$btnLogin;
            $btnLogin.unbind('click').click(loginVC.onLoginClick);
    
        var $inputPassword = $('input[name=password]');
            $inputPassword.keyup(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 13) {
                     loginVC.onLoginClick();
                }
            });
    };

    loginVC.onLoginClick = function() {
        var $boxLogin = loginVC.$boxLogin;
        var dataParam = {
            email    :   $boxLogin.find('input[name=email]').val(),
            password    :   $boxLogin.find('input[name=password]').val()   
        };
        
        apiClient.post('/users/login',dataParam,function(response){
            var sessionData = response.message;
            localStorage.setItem("sessionHash",sessionData.hash);
            window.location.href = "/dashboard";
            
        },function(responseError, status, error){
            console.log(typeof responseError.message);
            if( (typeof responseError.message) !== undefined){
                // Defined errors 
                console.log("other");
                alert(responseError.message);
            } else {
                // Internal error 500
                console.log("500");
                alert(responseError);
            }
        });
    };
    
    
    loginVC.initView();