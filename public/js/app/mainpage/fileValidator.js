'use strict';

export {FileValidator};

import {BaseValidator} from '../common/validators/baseValidator';
import {InvalidFileTypeError} from './errors/invalidFileTypeError';

function FileValidator() {

    this._regExp = null;
    this._allowExtensions = {
        image: ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico'],
        videos: ['mp4', 'avi', 'wmv', 'mov', 'mkv', '3gp', 'flw', 'swf'],
        audio: ['mp3', 'wav', 'wave', 'acc', 'ogg'],
        archive: ['7z', 'gz', 'rar', 'tar', 'tar-gz', 'tar.gz', 'zip', 'cbr']
    }
}

FileValidator.prototype = Object.create(BaseValidator.prototype);

FileValidator.prototype.validate = function (file) {
    this._fileExtensionIsAllowed(file.name);
    return true;
};

FileValidator.prototype._fileExtensionIsAllowed = function (fileName) {

    for (let fileType in this._allowExtensions) {
        if (this._checkCocnretExtension(fileName, this._allowExtensions[fileType])) {
            return true;
        }
    }
    throw new InvalidFileTypeError(`Incorrect extension file ${fileName}`);
};

FileValidator.prototype._checkCocnretExtension = function (fileName, extensions) {

    for (let i = 0; i < extensions.length; i++) {
        this._regExp = new RegExp("\\." + extensions[i] + "$");
        if (this._regExp.test(fileName)) {
            return true;
        }
    }
    return false;
};