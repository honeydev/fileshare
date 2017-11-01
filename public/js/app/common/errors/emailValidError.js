'use strict';

export {EmailValidError};

function EmailValidError(message) {
	Error.call(this, message);
	this.name = 'EmailValidError';
	this.message = message;
	this.stack = (new Error()).stack;
  
}

EmailValidError.prototype = Object.create(Error.prototype);