'use strict';

export {LocalStorage};

function LocalStorage(dic) {
    this._dic = dic;
}

LocalStorage.prototype.setItem = function (itemName, itemValue) {
    localStorage.setItem(itemName,  itemValue);
};

LocalStorage.prototype.getItem = function (itemName) {
    let requiredItem = localStorage.getItem(itemName);
    if (requiredItem != null && requiredItem != undefined) {
        requiredItem = JSON.parse(requiredItem);
    }
    return requiredItem;
};

LocalStorage.prototype.createObjectFromStorage = function (objectName, args = []) {
    const OBJECT_DATA = this.getItem(objectName);
    let targetObject = this._dic.get(objectName)(...args);
    if (OBJECT_DATA !== null && OBJECT_DATA !== undefined && OBJECT_DATA !== "undefined") {
        for (let prop in OBJECT_DATA) {
            targetObject.set(prop, OBJECT_DATA[prop]);
        }
    }
    console.log('storageData', OBJECT_DATA, 'target object', targetObject);
    return targetObject;
};