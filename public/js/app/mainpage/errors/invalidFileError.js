'use strict';

export {InvalidFileError};

function InvalidFileError(message) {
    Error.call(this, message);
    this.name = 'EmailValidError';
    this.message = message;
    this.stack = (new Error()).stack;
}

InvalidFileError.prototype = Object.create(Error.prototype);
