/**
 * Created by honey on 30/10/17.
 */

export {commonBootstrap};

import {Ajax} from './ajax.js';
import {LoginForm} from './loginForm.js';
import {RegisterForm} from './registerForm.js';
import {EmailValidator} from  './validators/emailValidator.js';
import {PasswordValidator} from './validators/passwordValidator';
import {LoginFormSetter} from './loginFormSetter';

function commonBootstrap() {
    dic.add('Ajax', function(...args) {
        return new Ajax(...args);
    });
    dic.add('LoginForm', function(...args) {
        return new LoginForm(...args);
    });
    dic.add('RegisterForm', function(...args) {
        return new RegisterForm(...args);
    });
    dic.add('EmailValidator', function(...args) {
        return new EmailValidator(...args);
    });
    dic.add('PasswordValidator', function(...args) {
        return new PasswordValidator(...args);
    });
    dic.add('LoginFormSetter', function(...args) {
        return new LoginFormSetter(...args);
    });
}