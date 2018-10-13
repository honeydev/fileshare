'use strict';

export {ImageTypeError};

function ImageTypeError(message) {
	Error.call(this, message);
	this.name = 'FileTypeError';
	this.message = message;
	this.stack = (new Error()).stack;
}

ImageTypeError.prototype = Object.create(Error.prototype);