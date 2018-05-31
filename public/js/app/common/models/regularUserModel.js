'use strict';

export {RegularUserModel};

import {BaseModel} from './baseModel';

function RegularUserModel() {
    this._email = null;
    this._accessLvl = 1;
    this._name = null;
    this._avatarUri = null;
    this._id = null;
    this._token = null;
}


RegularUserModel.prototype = Object.create(BaseModel.prototype);
RegularUserModel.prototype.constructor = RegularUserModel;