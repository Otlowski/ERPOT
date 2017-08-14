/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var registerVC ={};
    registerVC.$boxRegister = $("[data-function=box-register]");
    registerVC.$btnRegister = $("[data-function=button-register]");
    
    registerVC.initView = function(){
        var $btnRegister = registerVC.$btnRegister;
            $btnRegister.unbind('click').click(registerVC.onRegisterClick);
            
        var $inputRepeatPassword = $('input[name=password_confirm]');
            $inputRepeatPassword.keyup(function(e){
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code == 13)
                {
                    registerVC.onRegisterClick();
                }
            });
    };
    
    registerVC.onRegisterClick = function(){
        var $boxRegister = registerVC.$boxRegister;
        var dataParam = {
            email           :   $boxRegister.find('input[name=email]').val(),
            username        :   $boxRegister.find('input[name=username]').val(),
            password        :   $boxRegister.find('input[name=password]').val(),
            password_confirm:   $boxRegister.find('input[name=password_confirm]').val()
        };
        
        apiClient.post('/users/registerUser',dataParam,function(response){
            if('success' !== response.status) { alert('akcja zwiazana z bledem....'); return;  }
            
            window.location.href = "login";           
            
        },function(responseError, status, error){
            console.log(typeof responseError.reponse);
            if( (typeof responseError.message) !== undefined){
                //Defined errors
                console.log("other");
                alert(responseError.message);
            }else{
                //Internal error 500
                console.log("500");
                alert(responseError);
            }
                    
        });
    };
    
    registerVC.initView();