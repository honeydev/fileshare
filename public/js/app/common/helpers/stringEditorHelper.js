'use strict';

export {StringEditorHelper};

function StringEditorHelper() {

}
/**
 * @param  {string} string 
 * @return {string}
 */
StringEditorHelper.prototype.toUpperCaseFirstWord = function (string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}