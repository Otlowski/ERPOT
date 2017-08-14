var downloader = {};
    
    
    /**
     * Download file using iframe without opening new window
     * @param {string} url Relative request link
     * @returns {file}
     */
    downloader.downloadFile = function(url) {
        var hiddenIFrameID = 'hiddenDownloader';
            iframe = document.getElementById(hiddenIFrameID);
            if (iframe === null) {
                iframe = document.createElement('iframe');
                iframe.id = hiddenIFrameID;
                iframe.style.display = 'none';
                document.body.appendChild(iframe);
            }
            iframe.src = url;
    };