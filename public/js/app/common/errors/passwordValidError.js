'use strict';

export {PasswordValidError};

function PasswordValidError(message) {
	Error.call(this, message);
	this.name = 'PasswordValidatorError';
	this.message = message;
	this.stack = (new Error()).stack;
}

PasswordValidError.prototype = Object.create(Error.prototype);