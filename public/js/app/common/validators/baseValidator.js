'use strict';

export {BaseValidator};

function BaseValidator() {
    this._regExp = null;
}

/**
 * @param string
 * @returns {boolean}
 * @protected
 */
BaseValidator.prototype._dataIsMatchRegExp = function(string) {
    return this._regExp.test(string);
};