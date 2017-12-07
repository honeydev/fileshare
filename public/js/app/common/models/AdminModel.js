'use strict';

export {AdminModel};

import {RegularUserModel} from './regularUserModel';

function AdminModel() {
    this._accessLvl = 2;
}

AdminModel.prototype = Object.create(RegularUserModel.prototype);