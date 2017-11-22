'use strict';

export {FileUploader};

function FileUploader(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._fileValidator = dic.get('FileValidator')(dic);
}

FileUploader.prototype.uploadFile = function (file) {
    try {
        this._fileValidator.validate(file);
        this._ajax.sendFile(file, 'upload.file');
    } catch (Error) {

    }
};