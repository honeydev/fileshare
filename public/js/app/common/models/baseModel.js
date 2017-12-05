'use strict';

export {BaseModel};

function BaseModel() {

}
/**
 * @param {string} 
 * @return {mixed} [description]
 */
BaseModel.prototype.get = function (property) {
    if (this.hasOwnProperty(property)) {
        return this[property];
    }
    throw new Error(`Undefined property ${property} in class ${this.constructor.name}`);
};
/**
 * @param {string}
 * @param {string}
 * @return {void}
 */
BaseModel.prototype.set = function (propertyName, propertyValue) {
    if (this.hasOwnProperty(propertyName)) {
        this[propertyName] = propertyValue;
    }
    throw new Error(`Undefined property ${propertyName} in class ${this.constructor.name}`);
};