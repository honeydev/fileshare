'use strict';

export {BaseModel};

function BaseModel() {

}
/**
 * @param {string} 
 * @return {mixed}
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
        return true;
    }
    throw new Error(`Undefined property ${propertyName} in class ${this.constructor.name}`);
};

BaseModel.prototype.setStatic = function (propertyName, propertyValue) {
    if (this.constructor.hasOwnProperty(propertyName)) {
        this.constructor[propertyName] = propertyValue;
        return true;      
    }
    throw new Error(`Undefined property ${propertyName} in class ${this.constructor.name}`)
};

/** @return {object} */
BaseModel.prototype.getAllProperties = function () {
    let properties = {};
    let ownKeys = Object.keys(this);
    for (let key of ownKeys) {
        properties[key] = this[key];
    }
    return properties;
};