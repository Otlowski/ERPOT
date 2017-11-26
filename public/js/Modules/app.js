App = {};

App.checkLogin = function(){
    console.log('checkLOGIN METHOD JS');
    var sessionHash = localStorage.getItem('sessionHash');
    
    var dataParam = {
        hash : sessionHash
    };
    apiClient.post('users/isLogged', dataParam, function(response) {
        console.log('check response : ',+ response);
        if(response.status !== 'success'){
            window.location.href = '/login';
            console('error');
            return;
        }
        console.log(response.message);
        
    },function(responseError){
        window.location.href = '/login';
        
        console('error');
    });
};
var lastPart = window.location.href.split("/").pop();

//alert(lastPart);
if( lastPart !== 'login') App.checkLogin();
