'use strict';

export {FileUploader};

import {InvalidFileTypeError} from './errors/invalidFileTypeError';

function FileUploader(dic) {
    this._session = dic.get("SessionModel");
    this._ajax = dic.get('Ajax')(dic);
    this._fileValidator = dic.get('FileValidator')(dic);
    this._uploadSectionSetter = dic.get('UploadSectionSetter')(dic);
}

FileUploader.prototype.uploadFile = function (file) {
    try {
        const TOKEN = this._session.get("_user").get("_token");
        let headers = {};
        if (TOKEN !== null && TOKEN !== undefined) {
            headers = {
                "Authorization": `Bearer ${TOKEN}`
            }
        }
        this._ajax.sendFile({
            url: "/api/uploadfile",
            file: { file: file },
            headers: headers
        });
    } catch (Error) {
        if (Error instanceof InvalidFileTypeError) {
    		console.log('Invalid file format');
    		console.log(this._uploadSectionSetter);
    		console.log(this._uploadSectionSetter.setInvalidFileFormatModal());
    	}
    }
};

FileUploader.prototype._handler = function (response) {
    console.log(response);
};