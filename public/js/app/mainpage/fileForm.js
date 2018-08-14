'use strict';

export {FileForm};

function FileForm(dic) {
    this._fileUploader = dic.get('FileUploader')(dic);
    this._fileFormSetter = dic.get("FileFormSetter")(dic);
    this._progressBar = dic.get("ProgressBar")(dic);
}
/**
 * @param file File
 */
FileForm.prototype.send = function (file) {
    this._progressBar.activate();
}