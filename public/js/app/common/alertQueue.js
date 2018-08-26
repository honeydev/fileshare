'use strict'

export {AlertQueue};

import {alertQueueTemplate} from './templates/alert';
/**
 * [AlertQueue responsible for the management of messages for the user, create, delete]
 */
function AlertQueue(dic) {
    /**
     * @property {array}
     */
    this._alertQueue = [];
    this._dic = dic;
}

AlertQueue.prototype.activate = function () {
    if (!Boolean($('#alertsQueue').length)) {
       $('main').append(alertQueueTemplate);     
   }
};
/**
 * @param {sting} message
 * @object {params} hash map with dom propertyes
 * for alert dom element
 */
AlertQueue.prototype.add = function (message, params) {
    let alert = this._dic.get('Alert')(message, params);
    if (this._alertQueue.length > 2) {
        let firstAlert = this._alertQueue.shift();
        firstAlert.remove();
        alert.show();
        this._alertQueue.push(alert);
    } else {
        alert.show();
        this._alertQueue.push(alert);
    }
    this._alertRemoveLoop();
};
/**
 ** @return {array} alertQueue
 */
AlertQueue.prototype.getQueue = function () {
    return this._alertQueue;
};

AlertQueue.prototype._alertRemoveLoop = function () {
    setTimeout(() => {
        let firstAlert = this._alertQueue.shift();
        firstAlert.remove();
        if (this._alertQueue.length > 0) {
            this._alertRemoveLoop();
        }
    }, 10000);
};
