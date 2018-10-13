/**
 * Created by honey on 02/11/17.
 */

export {NameValidError};

function NameValidError(message) {
    Error.call(this, message);
    this.name = 'EmailValidError';
    this.message = message;
    this.stack = (new Error()).stack;
}

NameValidError.prototype = Object.create(Error.prototype);