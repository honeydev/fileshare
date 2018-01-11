'use strict';

export {Ajax};

function Ajax(dic) {
    this._logger = dic.get('Logger')(dic);
    this._urlHelper = dic.get('UrlHelper')(dic);
}

Ajax.prototype.sendJSON = function (requestSettings) {
    const requestJSON = JSON.stringify(requestSettings.requestData);
    const URL = this._urlHelper.correctUrl(requestSettings.url);
    $.ajax({
        url: URL,
        method: requestSettings.method,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestJSON,
        success: requestSettings.requestHandler,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.requestHandler(JSON.parse(qXHR.responseText));
                this._logger.log('valid error json');
                this._logger.log(qXHR.responseText);
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid error json');
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
