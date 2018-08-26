'use strict';

export {FileValidator};

import {BaseValidator} from '../common/validators/baseValidator';
import {InvalidFileError} from './errors/invalidFileError';

function FileValidator(dic) {
    this._maxFileSize = dic.get("CONFIG")().maxFileSize;
    this._maxFileNameLen = dic.get("CONFIG")().maxFileNameLen;
}

FileValidator.prototype = Object.create(BaseValidator.prototype);

FileValidator.prototype.validate = function (file) {
    console.log('validate', file);
    if (file.size > this._maxFileSize) {
        throw new InvalidFileError(`
            File ${file.name} size ${file.size} largest than max allow file size ${this._maxFileSize}
                `);
    }

    if (file.name.length > this._maxFileNameLen) {
        throw new InvalidFileError(`
            File ${file.name} len largest than max allow file name len ${this._maxFileNameLen}
                `);        
    }
};

