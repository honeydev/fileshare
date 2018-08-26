'use strict';

import {InvalidFileError} from '../errors/invalidFileError';

export {UploadErrorHandler};

function UploadErrorHandler(dic) {
    this._alertQueue = dic.get('AlertQueue')(dic);
    this._alertQueue.activate();
}

UploadErrorHandler.prototype.handle = function (error) {
    if (error instanceof InvalidFileError) {
        this._alertQueue.add(error.message, {type: 'danger'})
    } else {
        throw Error;
    }
};