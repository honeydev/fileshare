/**
 * Created by honey on 26/10/17.
 */

'ues strict';

import {User} from './user.js';

function CommonUser() {
    this._ajax = this._dic.get('Ajax');
}

CommonUser.prototype.setUsername = () => {
    //
};