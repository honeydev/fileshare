'use strict';

export {Ajax};

function Ajax(dic) {
    this._logger = dic.get('Logger')(dic);
    this._urlHelper = dic.get('UrlHelper')(dic);
    this._debugger = dic.get('Debugger')(dic);
}

Ajax.prototype.sendJSON = function (requestSettings) {
    console.log('request settings', requestSettings);
    const requestJSON = JSON.stringify(requestSettings.requestData);
    const URL = this._urlHelper.correctUrl(requestSettings.url);
    this._logger.log('sended json', requestJSON);
    $.ajax({
        url: URL,
        method: requestSettings.method,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestJSON,
        success: requestSettings.responseHandler,
        headers: requestSettings.headers,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.responseHandler(JSON.parse(qXHR.responseText));
                this._logger.log('valid error json');
                this._logger.log(qXHR.responseText);
                this._debugger.openDebugger(qXHR.responseText);
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid error json');
                this._logger.log(qXHR.responseText);
                this._debugger.openDebugger(qXHR.responseText);
            }
        }
    });
};

Ajax.prototype.doAction = function (requestSettings) {
    const URL = this._urlHelper.correctUrl(requestSettings.url);
    $.ajax({
        url: URL,
        type: "GET",
        success: requestSettings.responseHandler,
        headers: requestSettings.headers,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.responseHandler(JSON.parse(qXHR.responseText));
                this._logger.log('valid json');
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid json');
                this._logger.log(qXHR.responseText);
            }
        }
    });
};

Ajax.prototype.sendFile = function (requestSettings) {
    console.log("Send file");
    const URL = this._urlHelper.correctUrl(requestSettings.url);
    let formData = new FormData();
    formData.append('file', requestSettings.data.file);
    $.ajax({
        url: URL,
        method: "POST",
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: requestSettings.responseHandler,
        headers: requestSettings.headers,
        xhr: requestSettings.xhr,
        error: (qXHR, textStatus, errorThrown) => {
            try {
                requestSettings.responseHandler(JSON.parse(qXHR.responseText));
                this._logger.log('valid error json');
                this._logger.log(qXHR.responseText);
                this._debugger.openDebugger(qXHR.responseText);
            } catch (e) {
                this._logger.log(e);
                this._logger.log('invalid error json');
                this._logger.log(qXHR.responseText);
                this._debugger.openDebugger(qXHR.responseText);
            }
        }
    });
};
