'use strict';

export {InvalidFileTypeError};

function InvalidFileTypeError(message) {
    Error.call(this, message);
    this.name = 'EmailValidError';
    this.message = message;
    this.stack = (new Error()).stack;
}

InvalidFileTypeError.prototype = Object.create(Error.prototype);
