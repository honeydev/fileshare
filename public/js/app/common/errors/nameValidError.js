'use strict';

export {NameValidError};

function NameValidError(message) {
    Error.call(this, message);
    this.name = 'EmailValidError';
    this.message = message;
    this.stack = (new Error()).stack;
}

NameValidError.prototype = Object.create(Error.prototype);