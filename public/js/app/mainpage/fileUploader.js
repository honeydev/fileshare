'use strict';

export {FileUploader};

import {InvalidFileTypeError} from './errors/invalidFileTypeError';

function FileUploader(dic) {
    this._sessionModel = dic.get("SessionModel")();
    this._ajax = dic.get('Ajax')(dic);
    this._fileValidator = dic.get('FileValidator')(dic);
    this._uploadSectionSetter = dic.get('UploadSectionSetter')(dic);
    this._progressBar = dic.get('ProgressBar')(dic);
    this._fileUploadHandler = dic.get("FileUploadHandler")(dic);
}
/**
 * @param {file} File
 */
FileUploader.prototype.uploadAnnonymous = function (file) {
    this._ajax.sendFile({
        url: location.host + "/api/uploadfile/annonym.file",
        data: { file: file },
        xhr: this._progressHandler.bind(this),
        responseHandler: this._fileUploadHandler.getHandler()
    });
}
/**
 * @param {file} File
 */
FileUploader.prototype.uploadAuthorized = function (file) {
    try {
        const TOKEN = this._sessionModel.get("_user").get("_token");
        this._ajax.sendFile({
            url: location.host + "/api/uploadfile/registred.file",
            data: { file: file },
            xhr: this._progressHandler.bind(this),
            headers: {
                "Authorization": `Bearer ${TOKEN}`
            },
            responseHandler: this._fileUploadHandler.getHandler()
        });
    } catch (Error) {
        if (Error instanceof InvalidFileTypeError) {
    		console.log('Invalid file format');
    		console.log(this._uploadSectionSetter);
    		console.log(this._uploadSectionSetter.setInvalidFileFormatModal());
    	} else {
            throw Error;
        }
    }
};

FileUploader.prototype._handler = function (response) {
    console.log(response);
};
/**
 * @return XMLHttpRequest
 */
FileUploader.prototype._progressHandler = function () {
    let xhr = new window.XMLHttpRequest();
    xhr.upload.addEventListener("progress", (progressEvent) => {
        console.log("progress")
        if (progressEvent.lengthComputable) {
            let percentCompleteDecimal = progressEvent.loaded / progressEvent.total;
            let percentComplete = Math.round(percentCompleteDecimal * 100);
            this._progressBar.setProgress(percentComplete);
        }
    }, false);
    return xhr;
};