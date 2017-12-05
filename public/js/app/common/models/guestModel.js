'use strict';

export {GuestModel};

import {BaseModel} from './baseModel';

function GuestModel() {
    this._name = 'guest';
    this._accessLvl = 0;
}

GuestModel.prototype = Object.create(BaseModel.prototype);