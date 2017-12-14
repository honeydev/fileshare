'use strict';

export {SessionModelTest};

import {assert} from 'chai';
import {bootstrap} from './bootstrap';
import {SessionModel} from '../app/common/models/sessionModel';

function SessionModelTest() {

}

SessionModelTest.prototype.test = function () {
    this._getSessionModelInstance();
};

SessionModelTest.prototype._getSessionModelInstance = function () {
    describe(`Try get SessionModel instance`, () => {
        it(`create new instance`, () => {
            let sessionModel = SessionModel.getInstance();
            assert.instanceOf(sessionModel, SessionModel);
        });
        it(`get existed instance`, () => {
            let sessionModel = SessionModel.getInstance();
            sessionModel.set('_authorizeStatus', true);
            sessionModel.set('_accessLvl', 1);
            sessionModel = SessionModel.getInstance();
            assert.equal(true, sessionModel.get('_authorizeStatus'),
                'existed object property must equal');
            assert.equal(1, sessionModel.get('_accessLvl'),
                'existed object property must equal');
        });
    });
};

let sessionModelTest = new SessionModelTest();
sessionModelTest.test();