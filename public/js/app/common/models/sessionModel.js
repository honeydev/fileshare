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

    this._ip = null;
}

SessionModel.prototype = Object.create(BaseModel.prototype);
