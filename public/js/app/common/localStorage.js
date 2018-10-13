'use strict';

export {LocalStorage};

function LocalStorage(dic) {
    this._dic = dic;
}
/**
 * 
 * @param {string}
 * @param {mixed} itemValue [description]
 */
LocalStorage.prototype.setItem = function (itemName, itemValue) {
    localStorage.setItem(itemName,  JSON.stringify(itemValue));
};
/** @return {mixed} */
LocalStorage.prototype.getItem = function (itemName) {
    let requiredItem = JSON.parse(localStorage.getItem(itemName));
    console.log('required item', requiredItem);
    return requiredItem;
};

/** @return {void} */
LocalStorage.prototype.removeItem = function (itemName) {
    localStorage.removeItem(itemName);
};