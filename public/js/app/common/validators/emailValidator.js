'use strict';

export {EmailValidator};

import {BaseValidator} from './baseValidator.js';
import {EmailValidError} from '../errors/emailValidError.js';

function EmailValidator() {
    this._regExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
}

EmailValidator.prototype = Object.create(BaseValidator.prototype);

EmailValidator.prototype.validate = function(email) {
    if (this._dataIsMatchRegExp(email)) {
        return true;
    }
    throw new EmailValidError(`Invalid email ${email}`);
};
