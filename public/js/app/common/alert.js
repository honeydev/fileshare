'use strict';

import {alertTemplate} from './templates/alert';

export {Alert};
/**
 * @class Alert responsible for the status of the message to the user
 * @param {sting} message
 * @object {params} hash map with dom propertyes
 * for alert dom element
 */
function Alert(message, params) {
    this._message = message;
    this._type = params.type;
    this._alert = $(alertTemplate);
}

Alert.prototype.show = function () {
    $('#alertsQueue').append(this._alert);
    this._alert.text(this._message);
    this._alert.addClass(`alert-${this._type}`);
};

Alert.prototype.remove = function () {
    this._alert.remove();
};