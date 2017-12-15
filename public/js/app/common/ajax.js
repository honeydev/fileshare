'use strict';

export {Ajax};

function Ajax(dic) {
    this._logger = dic.get('Logger')(dic);
}

Ajax.prototype.sendJSON = function (requestSettings) {
    let json = JSON.stringify(requestSettings.requestData);
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
                this._logger.log('valid json');
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid json');
                this._logger.log(qXHR.responseText);
            }
        }
    });
};


Ajax.prototype.doAction = function (requestSettings) {
    $.ajax({
        url: requestSettings.url,
        type: "GET",
        success: requestSettings.requestHandler,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.requestHandler(JSON.parse(qXHR.responseText));
                this._logger.log('valid json');
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid json');
                this._logger.log(qXHR.responseText);
            }
        }
    });
};

Ajax.prototype.sendFile = function (file, url) {

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
