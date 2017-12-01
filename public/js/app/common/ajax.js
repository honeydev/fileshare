'use strict';

export {Ajax};

function Ajax() {

}

Ajax.prototype.sendJSON = function(requestSettings) {
    let json = this._stringify(requestSettings.requestData);
    $.ajax({
        url: requestSettings.url,
        method: requestSettings.method,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: json,
        success: requestSettings.requestHandler,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.requestHandler(JSON.parse(qXHR.responseText));
                console.log('valid json');
            } catch (e) {
                console.log(e);
                console.log('invalid json');
                console.log(qXHR.responseText);
            }
        }
    });
};

Ajax.prototype.sendFile = function(file, url) {

    let formData = new FormData();
    formData.append('file', file);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
    });
};


Ajax.prototype._stringify = function(requestData) {
    return JSON.stringify(requestData);
};
