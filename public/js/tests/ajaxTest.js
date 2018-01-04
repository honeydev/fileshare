'use strict';



const jsdom = require('jsdom');
const { JSDOM } = jsdom;
const page = new JSDOM('', {
    url: "http://fileshare.dev"
});
const $ = require('jquery')(page.window);

function AjaxTest() {
    
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
console.log($)
