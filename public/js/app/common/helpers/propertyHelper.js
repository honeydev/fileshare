'use strict';

export {PropertyHelper};

function PropertyHelper() {

}
/** 
 * @param  {object} list
 * @return {object} list
 */
PropertyHelper.prototype.correctPropertyList = function (propertyList) {
    let correctedList = {};
    for (let propertyName in propertyList) {
        if (this._propertyIsPrivate(propertyName)) {
            let correctPropertyName = this._correctPrivatePropertyName(propertyName);
            correctedList[correctPropertyName] = propertyList[propertyName];
        } else {    
            correctedList[propertyName] = propertyList[propertyName];
        }
    }
    return correctedList;
};
/**
 * @param  {string} propertyName
 * @return {string}
 */
PropertyHelper.prototype._correctPrivatePropertyName = function (propertyName) {
    const PROP_MAX_INDEX = propertyName.length;
    return propertyName.slice(1, PROP_MAX_INDEX);
};
/**
 * @param  {string} propertyName 
 * @return {bool}
 */
PropertyHelper.prototype._propertyIsPrivate = function (propertyName) {
    if (propertyName.slice(0, 1) == '_') {
        return true;
    }
    return false;
};
