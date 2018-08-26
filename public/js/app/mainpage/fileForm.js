'use strict';

export {FileForm};

import {GuestModel} from '../common/models/guestModel';

function FileForm(dic) {
    this._fileUploader = dic.get('FileUploader')(dic);
    this._progressBar = dic.get("ProgressBar")(dic);
    this._ajax = dic.get("Ajax")(dic);
    this._sessionModel = dic.get("SessionModel")(dic);
    this._fileValidator = dic.get("FileValidator")(dic);
    this._uploadErrorHandler = dic.get("UploadErrorHandler")(dic);
}
/**
 * @param file File
 */
FileForm.prototype.send = function (file) {
    try {
        this._fileValidator.validate(file);        
    } catch (Error) {
        this._uploadErrorHandler.handle(Error);
        return false;
    }
    this._progressBar.activate();
    this._sendFile(file);
};

FileForm.prototype._sendFile = function(file) {
    try {
        if (this._sessionModel._authorizeStatus) {
            console.log('upload auth')
            this._fileUploader.uploadAuthorized(file);
        } else {
            console.log('upload annon')
            this._fileUploader.uploadAnnonymous(file);
        }     
    } catch (Error) {
        
    }
};
