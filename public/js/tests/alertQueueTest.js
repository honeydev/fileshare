'use strict';

export {AlertQueueTest};

import {BaseTest} from './baseTest';
import {Alert} from '../app/common/alert';
import {assert} from 'chai';

function AlertQueueTest(dic) {
    this._dic = dic;
    this._alertQueue = dic.get('AlertQueue')(dic);
}

AlertQueueTest.prototype = Object.create(BaseTest.prototype);
AlertQueueTest.prototype.constructor = AlertQueueTest;

AlertQueueTest.prototype.test = function () {
    let context = this;
    describe('Test AlertQueue class', function () {
        it('Test add alerts element on page', function () {
            context._createDom();
            context._alertQueue.activate();
            assert.isTrue(Boolean($('#alertsQueue').length), 'check element exist');
            context._removeDom();
        });
        it('Test add alert in queue', function () {
            context._createDom();
            context._alertQueue.activate();      
            context._alertQueue.add('hello world', {
                type: 'danger'
            });
            let queue = context._alertQueue.getQueue();
            assert.lengthOf(queue, 1);
            let alert = queue[0];
            assert.instanceOf(alert, Alert, 'alert instance Alert class');
            context._removeDom();
        });
        it('Test add some alerts in queue', function () {
            context._createDom();
            context._alertQueue.activate();
            for (let i = 0; i < 7; i++) {
                context._alertQueue.add('hello world', {
                    type: 'danger'
                });
            }
            assert.lengthOf(context._alertQueue.getQueue(), 3, 'When elements count > 3, remove first element');
            context._removeDom();
        });
    });
};

AlertQueueTest.prototype._createDom = function () {
    $('body').append('<main></main>');
};

AlertQueueTest.prototype._removeDom = function () {
   $('main').remove();
};