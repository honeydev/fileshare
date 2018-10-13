'use strict';

export {AdminModel};

import {RegularUserModel} from './regularUserModel';

function AdminModel() {
    RegularUserModel.apply(this, arguments);
    this._accessLvl = 2;
}

AdminModel.prototype = Object.create(RegularUserModel.prototype);
AdminModel.prototype.constructor = RegularUserModel;
