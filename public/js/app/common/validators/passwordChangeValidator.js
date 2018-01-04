'use strict';

export {PasswordChangeValidator};

function PasswordChangeValidator(dic) {
	this._passwordValidator = dic.get('PasswordValidator')();
}

PasswordChangeValidator.prototype.validate = function () {

};
