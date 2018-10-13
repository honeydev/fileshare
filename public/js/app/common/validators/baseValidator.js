/**
 * Created by honey on 30/10/17.
 */

'use strict';

export {BaseValidator};

function BaseValidator() {
    this._regExp = null;
}

BaseValidator.prototype._dataIsMatchRegExp = function(string) {
    if (this._regExp.test(string)) {
        return true;
    }
    return false;
};