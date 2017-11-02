/**
 * Created by honey on 30/10/17.
 */

export {commonBootstrap};

import {Ajax} from './ajax.js';
import {LoginForm} from './loginForm.js';
import {RegisterForm} from './registerForm.js';
import {EmailValidator} from  './validators/emailValidator.js';
import {PasswordValidator} from './validators/passwordValidator.js';
import {NameValidator} from './validators/nameValidator.js';
import {LoginFormSetter} from './loginFormSetter';
import {RegisterFormSetter} from './registerFormSetter';

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
    dic.add('NameValidator', function(...args) {
        return new NameValidator(...args);
    });
    dic.add('LoginFormSetter', function(...args) {
        return new LoginFormSetter(...args);
    });
    dic.add('RegisterFormSetter', function(...args) {
        return new RegisterFormSetter(...args);
    });
}