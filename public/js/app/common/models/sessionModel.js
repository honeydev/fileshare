'use strict';

export {SessionModel};

import {BaseModel} from './baseModel';

function SessionModel() {
    /**
     * @property bool, if true - user authorized now
     */
    this._authorizeStatus = false;
    /**
     * @property int user access lvl
     * 0 - guest
     * 1 - user
     * 2 - administrator
     */
    this._accessLvl = null;
    /** @property {object} user model object */
    this._user = null;
    /** @property {string} */
    this._ip = null;
    /** @property {object} instance of SessionModel */
    SessionModel._sessionModel = null;
}
/** realise patter singletone */
SessionModel.getInstance = function () {
    if (SessionModel._sessionModel === null || SessionModel._sessionModel === undefined) {
        SessionModel._sessionModel = new SessionModel();
        return SessionModel._sessionModel;
    }
    if (SessionModel._sessionModel instanceof SessionModel) {
        return SessionModel._sessionModel;
    }
    throw new Error(`Invalid sessionModel value ${SessionModel._sessionModel}`);
};

SessionModel.prototype = Object.create(BaseModel.prototype);
SessionModel.prototype.constructor = SessionModel;
