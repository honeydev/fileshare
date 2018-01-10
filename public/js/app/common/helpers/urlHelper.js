'use strict';

export {UrlHelper};

function UrlHelper() {

}
/**
 * @param  {string]} url
 * @return {string}
 */
UrlHelper.prototype.correctUrl = function (url) {
    if (!this._hasHttpInUrl(url)) {
        url = "http://" + url;
    }
    return url;
};
/**
 * @param  {string}  url 
 * @return {Boolean}   
 */
UrlHelper.prototype._hasHttpInUrl = function (url) {
    const HTTP_REGEXP = /^(http:\/\/|https:\/\/)/;
    if (HTTP_REGEXP.test(url)) {
        return true;
    }
    return false; 
};