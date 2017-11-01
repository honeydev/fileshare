/**
 * Created by honey on 30/10/17.
 */

'use strict';

export {PasswordValidator};

import {BaseValidator} from './baseValidator';
import {PasswordValidError} from '../errors/passwordValidError.js';

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
