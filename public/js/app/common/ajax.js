'use strict';

export {Ajax};

function Ajax() {

}

Ajax.prototype.sendJSON = function(url, requestData, method = 'POST') {
    let json = this._stringify(requestData);
    $.ajax({
        url: url,
        method: method,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: json,
        success: function (response) {
            console.log(response);
        },
        error: function ( qXHR, textStatus, errorThrown ) {
            // console.log(textStatus, ' ', errorThrown, qXHR.responseText);
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
