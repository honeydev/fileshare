/**
 * Created by honey on 30/10/17.
 */

'use strict';

export {NameValidator};

import {BaseValidator} from 'baseValidator';

function NameValidator() {
    this._regExp = /^([a-zа-я]|[0-9]| ){0,20}$/iu;
}

NameValidator.prototype = BaseValidator.prototype;

NameValidator.prototype.validate = function(name) {
    if (this._dataIsMatchRegExp(name)) {
        return true;
    }
    throw new Error(`Invalid name (surname) ${name}`);
};
