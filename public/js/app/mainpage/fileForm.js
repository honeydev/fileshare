'use strict';

export {FileForm};

import {GuestModel} from '../common/models/guestModel';

function FileForm(dic) {
    this._fileUploader = dic.get('FileUploader')(dic);
    this._fileFormSetter = dic.get("FileFormSetter")(dic);
    this._progressBar = dic.get("ProgressBar")(dic);
    this._ajax = dic.get("Ajax")(dic);
    this._sessionModel = dic.get("SessionModel")(dic);
}
/**
 * @param file File
 */
FileForm.prototype.send = function (file) {
    this._progressBar.activate();
    let user = this._sessionModel.get("_user");
    if (this._sessionModel._authorizeStatus) {
        console.log('upload auth')
        this._fileUploader.uploadAuthorized(file);
    } else {
        console.log('upload annon')
        this._fileUploader.uploadAnnonymous(file);
    }
}
