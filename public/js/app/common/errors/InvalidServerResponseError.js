'use strict';

export {InvalidServerResponseError};

function InvalidServerResponseError(message) {
    Error.call(this, message);
    this.name = 'InvalidServerResponseError';
    this.message = message;
    this.stack = (new Error()).stack;
}

InvalidServerResponseError.prototype = Object.create(Error.prototype);
InvalidServerResponseError.prototype.constructor = InvalidServerResponseError;