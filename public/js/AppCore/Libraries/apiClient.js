/**
 * 
 * API Client librarie
 */
var apiClient = {};
    
    /**
    * Sending POST request
    * @param {string} requestUrl
    * @param {array} requestParams
    * @param {function} onSuccess
    */
    apiClient.post = function(requestUrl,requestParams,onSuccess,onError) {
        
        if("sessionHash" in localStorage){
            requestParams.hash = localStorage.getItem('sessionHash');
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        onSuccess = typeof onSuccess === 'undefined' ? this.onSuccessDefault : onSuccess;
        onError = typeof onError === 'undefined' ? this.onErrorDefault : onError;
        $.ajax({
            dataType:   "json",
            type:       "POST",
            data:       requestParams,
            url:        requestUrl,
            success:    onSuccess,
            error:      onError
        });
    };
    
    /**
    * Sending GET request
    * @param {string} requestUrl
    * @param {function} onSuccess
    */
    apiClient.get = function(requestUrl,onSuccess,onError) {
        
            onSuccess = typeof onSuccess === 'undefined' ? this.onSuccessDefault : onSuccess;
            onError = typeof onError === 'undefined' ? this.onErrorDefault : onError;
            $.ajax({
                dataType:   "json",
                type:       "GET",
                url:        requestUrl,
                success:    onSuccess,
                error:      onError
            });
    };
    
    
    /**
     * Success handling :: default
     * @param {type} request
     */
    apiClient.onSuccessDefault = function(request) {
        console.info('[SUCCESS]');
        console.log(request);
    };

    /**
     * Error handling :: default
     * @param {type} request
     * @param {type} status
     * @param {type} error
     */
    apiClient.onErrorDefault = function(request, status, error) {
        console.info('[ERROR]');
        console.log(request.status);
    };
