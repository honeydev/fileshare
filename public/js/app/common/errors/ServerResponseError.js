'use strict';

export {ServerResponseError};

function ServerResponseError(message) {
    Error.call(this, message);
    this.name = 'ServerResponseError';
    this.message = message;
    this.stack = (new Error()).stack;
}

ServerResponseError.prototype = Object.create(Error.prototype);