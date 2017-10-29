/**
 * Created by honey on 26/10/17.
 */

'ues strict';

import {User} from './user.js';

function Guest() {
    this.name = 'Guest';
    this.__proto__ = User;
}