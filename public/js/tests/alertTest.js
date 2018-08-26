'use strict';

export {AlertTest};

import {BaseTest} from './baseTest';
import {assert} from 'chai';

function AlertTest(dic) {
    this._dic = dic;
    this._alertQueue = dic.get("AlertQueue")(dic);
}

AlertTest.prototype = Object.create(BaseTest.prototype);
AlertTest.prototype.constructor = AlertTest;

AlertTest.prototype.test = function () {
    context = this;
    describe("Test AlertTest, test manipulation with alerts", function () {
        it("Test create alert", function () {
            context._createDom();
            let message = "Test message"
            let params = {
                type: 'danger'
            };
            let alert = context._dic.get('Alert')(message, params);
            alert.show();
            let alertDom = $('#alertsQueue').last();
            assert.equal(alert._message, message, 'message must equal');
            assert.equal(alert._type, params.type, 'type must equal');
            assert.equal($(alertDom).text(), message, 'Element must contain message text');
            context._removeDom();
        });
    });
}

AlertTest.prototype._createDom = function () {
    $('body').append('<main>');
    this._alertQueue.activate();
};

AlertTest.prototype._removeDom = function () {
    $('main').remove();
};
