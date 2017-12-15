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

/** @return {array} */
BaseModel.prototype.getAllProperties = function () {
	let properties = {};

	for (let property in this) {
		properties[property] = this[property];
	}
	return properties;
};