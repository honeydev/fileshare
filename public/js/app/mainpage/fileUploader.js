'use strict';

export {FileUploader};

import {InvalidFileTypeError} from './errors/invalidFileTypeError';

function FileUploader(dic) {
    this._ajax = dic.get('Ajax')(dic);
    this._fileValidator = dic.get('FileValidator')(dic);
    this._uploadSectionSetter = dic.get('UploadSectionSetter')(dic);
}

FileUploader.prototype.uploadFile = function (file) {
    try {
        this._fileValidator.validate(file);
        this._ajax.sendFile(file, 'upload.file');
    } catch (Error) {
    	if (Error instanceof InvalidFileTypeError) {
    		console.log('Invalid file format');
    		console.log(this._uploadSectionSetter);
    		console.log(this._uploadSectionSetter.setInvalidFileFormatModal());
    	}
    }
};