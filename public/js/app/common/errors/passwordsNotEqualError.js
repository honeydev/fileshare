'use strict';

export {PasswordsNotEqualError};

function PasswordNotEqualError(message) {
	Error.call(this, message);
	this.name = 'PasswordNotEqualError';
	this.message = message;
	this.stack = (new Error()).stack;
}

PasswordNotEqualError.prototype = Object.create(Error.prototype);
PasswordNotEqualError.prototype.constructor = PasswordNotEqualError;