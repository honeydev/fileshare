'use strict';

export {AjaxTest};

import {assert} from 'chai';
import {bootstrap} from './bootstrap';


function AjaxTest() {
    this._ajax = dic.get('Ajax')();
    console.log($());
    console.log(dic);
    console.log(jsdom);
}

AjaxTest.prototype.test = function () {

};

AjaxTest.prototype._sendCorrectRequest = function () {
    console.log(jsdom);
    describe('Send correct requests on server', () => {
        it('send correct JSON request', () => {
            /** @param object */
            let testFunction = function (response) {

                assert.equal(response.regStatus == 'success');
            };
            $.ajax({
                requestData: {
                    email: "devspades@gmail.com",
                    name: "alexey",
                    password: "a5123zv",
                    passwordRepeat: "a5123zv",
                    accessLvl: 1
                },
                "url": "register.form",
                "requestHandler": testFunction,
                "method": "POST"
            });
        });
    });
};

let ajaxTest = new AjaxTest();
//ajaxTest._sendCorrectRequest();