'use strict';

export {PropertyHelperTest};

import {assert} from 'chai';
import {bootstrap} from './bootstrap';

function PropertyHelperTest() {
    this._propertyHelper = dic.get('PropertyHelper')();
}

PropertyHelperTest.prototype.test = function () {
    this._addToTransformObjectWithPrivateProps();
};

PropertyHelperTest.prototype._addToTransformObjectWithPrivateProps = function () {
    describe(`Transformate object with property name type of "_propertyName"
        to "propertyName"`, () => {

            it(`return object without "_" symbol`, () => {
                let propertyList = {
                    _email: "email@email.com",
                    _name: "name",
                    _id: "id"
                };

                const CORRECT_RESULT_LIST = {
                    email: "email@email.com",
                    name: "name",
                    id: "id"
                };
                
                let resultList = this._propertyHelper.correctPropertyList(propertyList);
    
                for (let propertyName in resultList) {
                    assert.property(CORRECT_RESULT_LIST, propertyName);
                    assert.equal(CORRECT_RESULT_LIST[propertyName], resultList[propertyName]);
                }
            });

            it(`object with open property will not transform`, () => {
                let propertyList = {
                    email: "email@email.com",
                    name: "name",
                    id: "id"
                };

                const CORRECT_RESULT_LIST = {
                    email: "email@email.com",
                    name: "name",
                    id: "id"
                };

                let resultList = this._propertyHelper.correctPropertyList(propertyList);

                for (let propertyName in resultList) {
                    assert.property(CORRECT_RESULT_LIST, propertyName);
                    assert.equal(CORRECT_RESULT_LIST[propertyName], resultList[propertyName]);
                }
            });
        });
};

let propertyHelperTest = new PropertyHelperTest();
propertyHelperTest.test();