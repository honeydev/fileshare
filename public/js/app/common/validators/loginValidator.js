/**
 * Created by honey on 30/10/17.
 */

'use strict';

export {LoginValidator};

import {BaseValidator} from './baseValidator.js';

function LoginValidator() {
    this._regExp = /^[a-z]{1}([a-z]|[0-9]|\.|_|-){0,20}$/i;
}

LoginValidator.prototype = BaseValidator.prototype;

LoginValidator.prototype.validate = function(login) {
    if (this._dataIsMatchRegExp(login)) {
        return true;
    }
    throw new Error(`Invalid ${login}`);
};
