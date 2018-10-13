'use strict';

export {ImageValidator};

import {ImageTypeError} from '../errors/imageTypeError';

function ImageValidator() {

}

ImageValidator.prototype.validate = function (image) {
    this._checkMimeType(image.type);
};

ImageValidator.prototype._checkMimeType = function(mimeType) {
    const ALLOW_MIME_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'];
    if (ALLOW_MIME_TYPES.indexOf(mimeType) !== -1) {
        return true;
    }
    throw new ImageTypeError(`Invalid new avatar MIME type ${mimeType}`);
};