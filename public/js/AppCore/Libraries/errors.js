function showAlert(response) {
    var status = response.status;
    if(response.status === 'error') {
        var message = response.message;
        var errorCode = response.error.substring(4,8);
        console.log(errorCode);
        switch(errorCode) {
            case '0001' :
            case '0002' :
            case '0003' : showModalSessionExpired(); break;
            case '0005' : displayDefaultError(message); break;
            case '0010' :
            case '0011' :
            case '0012' : displayValidationError(message); break;
            default     : displayDefaultError(message); 

        }
    } else {
        console.log(response);
    }
}

function showModal(response) {
    var status = response.status;
    if(response.status === 'error') {
        var message = response.message;
        var errorCode = response.error.substring(4,8);
        console.log(errorCode);
        switch(errorCode) {
            case '0001' :
            case '0002' :
            case '0003' : showModalSessionExpired(); break;
            case '0005' : showModalNoAccess(response); break;
            case '0010' : 
            case '0011' : showModalError(response); break;
            case '0031' : showModalNoAccess(response); break;
            default     : showModalError(response);
        }
    } else {
        showModalServerError(response);
        console.log(response);
    }
}

function hideAlert() {
    //console.log("hide alert");
    $(".modal:visible .alert").html("").hide();
}

function showModalNoAccess(response) {
    $("#modal-noaccess-display").modal("show");
}
function showModalError(response) {
    $("#modal-error-display").find(".error-message").text(
        '[ '+response['error'] +' ] '+
        response['message']
    );
    $("#modal-error-display").modal("show");
}
function showModalServerError(response) {
    var error = response.responseJSON.error;
    $("#modal-error-display").find(".error-message").text(error.file);
    $("#modal-error-display").modal("show");
}
function showModalAlert(response) {
    $("#modal-alert-display").find(".alert-message").text(
        response['message']
    );
    $("#modal-alert-display").modal("show");
}
function showModalSessionExpired() {
    $(".modal:visible").modal("hide");
    $("#modal-login-display").modal('show');
    //console.log("Auto redirect in next 15 sec.");
    setInterval(function(){
        //redirect to main page
        window.location.href = "/";
    },15000);
}

function displayValidationError(message) {
    var validationError = '';
    for (errorKey in message ) 
            validationError = message[errorKey];
        
    $(".modal:visible .alert").html("");
    $(".modal:visible .alert").html(validationError);
    $(".modal:visible .alert").slideDown();
    $(".modal:visible .alert").unbind("click").click(function() { $(this).slideUp(); });
}

function displayDefaultError(message) {
    var $modal = $(".modal:visible");
        $modal.find(".alert").hide();
        $modal.find(".alert").html("");
        $modal.find(".alert").html(message);
        $modal.find(".alert").slideDown();
        $modal.find(".alert").unbind("click").click(function() { $(this).slideUp(); });
}
