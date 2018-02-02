/**
 * Created by honey on 30/10/17.
 */

'use strict';

export {PasswordValidator};

import {BaseValidator} from './baseValidator';
import {PasswordValidError} from '../errors/passwordValidError.js';
import {PasswordsNotEqualError} from '../errors/passwordsNotEqualError';

function PasswordValidator() {
    this._regExp = /^([a-z]|[0-9]|@|#|\$|%|\+|&|\*|\(|\)|!|~|@|\^|_|-|=){5,20}$/i;
}

PasswordValidator.prototype = Object.create(BaseValidator.prototype);

PasswordValidator.prototype.validate = function(password) {
    if (this._dataIsMatchRegExp(password)) {
        return true;
    }
    throw new PasswordValidError(`Invalid password ${password}`);
};

PasswordValidator.prototype.checkEqual = function (password, passwordRepeat) {
    if (password === passwordRepeat) {
        return true;
    }
    throw new PasswordsNotEqualError(`Input ${password} and ${passwordRepeat} is not equal`);
};