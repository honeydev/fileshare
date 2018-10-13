'use strict';

export {BaseTest};

function BaseTest() {

}
/**
 * @param {string} url
 * @param {string} element id or element class name 
 * @param {function} mocha test framework function for async code
 */
BaseTest.prototype._createDomEnv = function (url, element, done) {
    if (!this._hasHttpInUrl(url)) {
        url = 'http://'+url;
    }

    const REQUEST = $.get(url, function () {
        const PAGE = REQUEST.responseText;
        const TARGET_ELEMENT = $(PAGE).find(element);
        $('body').append(TARGET_ELEMENT);
        done();
    });
};

BaseTest.prototype._removeDomEnv = function (elem) {
    $(elem).remove();
};

BaseTest.prototype._hasHttpInUrl = function (url) {
    const HTTP_REGEXP = /^(http:\/\/|https:\/\/)/;
    if (HTTP_REGEXP.test(url)) {
        return true;
    }
    return false; 
};