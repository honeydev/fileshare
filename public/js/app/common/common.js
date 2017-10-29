/**
 * Created by honey on 26/10/17.
 */
export {common};

import 'bootstrap';
import 'dic';
import {Ajax} from './ajax.js';
import {CommonHandlers} from './commonHandlers.js';
import {LoginForm} from './loginForm.js';
import {RegisterForm} from './registerForm.js';
import style from 'bootstrap/dist/css/bootstrap.min.css';
import style from '../../../css/styles.css';

let common = function() {
    parsley;
    dic.add('Ajax', function(...args) {
        return new Ajax(...args);
    });
    dic.add('LoginForm', function(...args) {
        return new LoginForm(...args);
    });
    dic.add('RegisterForm', function(...args) {
        return new RegisterForm(...args);
    });
    let handlers = new CommonHandlers(dic);
    handlers.setHandlers();
};