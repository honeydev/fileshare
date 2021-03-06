'use strict';

export {Logger};

function Logger(dic) {
    this._debug = dic.get('CONFIG')()['debug'];
}

Logger.prototype.log = function (logMessage) {
    if (this._debug) {
        console.log(logMessage);
    }
};