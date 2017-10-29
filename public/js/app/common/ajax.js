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
        data: json
    });
};

Ajax.prototype.sendFile = function(file, url) {

    $.ajax({
        url: url,
        type: 'POST',
        data: file,
        processData: false,
        contentType: false
    });
};


Ajax.prototype._stringify = function(requestData) {
    return JSON.stringify(requestData);
};
