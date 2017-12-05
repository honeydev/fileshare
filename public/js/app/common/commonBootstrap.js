/**
 * Created by honey on 30/10/17.
 */

export {commonBootstrap};

import {Ajax} from './ajax';
import {LoginForm} from './loginForm';
import {RegisterForm} from './registerForm';
import {EmailValidator} from  './validators/emailValidator';
import {PasswordValidator} from './validators/passwordValidator';
import {NameValidator} from './validators/nameValidator';
import {LoginFormSetter} from './setters/loginFormSetter';
import {RegisterFormSetter} from './setters/registerFormSetter';
import {GuestModel} from './models/guestModel';
import {SessionModel} from './models/sessionModel';

function commonBootstrap() {
    dic.add('GuestModel', function (...args) {
        return new GuestModel(...args);
    });
    dic.add('SessionModel', function (...args) {
        return new SessionModel;
    });
    dic.add('Ajax', function (...args) {
        return new Ajax(...args);
    });
    dic.add('LoginForm', function (...args) {
        return new LoginForm(...args);
    });
    dic.add('RegisterForm', function (...args) {
        return new RegisterForm(...args);
    });
    dic.add('EmailValidator', function (...args) {
        return new EmailValidator(...args);
    });
    dic.add('PasswordValidator', function (...args) {
        return new PasswordValidator(...args);
    });
    dic.add('NameValidator', function (...args) {
        return new NameValidator(...args);
    });
    dic.add('LoginFormSetter', function (...args) {
        return new LoginFormSetter(...args);
    });
    dic.add('RegisterFormSetter', function (...args) {
        return new RegisterFormSetter(...args);
    });
}