'use strict';

export {PasswordsNotEqualError};

function PasswordsNotEqualError(message) {
	Error.call(this, message);
	this.name = 'PasswordNotEqualError';
	this.message = message;
	this.stack = (new Error()).stack;
}

PasswordsNotEqualError.prototype = Object.create(Error.prototype);
PasswordsNotEqualError.prototype.constructor = PasswordsNotEqualError;