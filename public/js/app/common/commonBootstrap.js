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
import {AuthorizedStatmentSetter} from './setters/authorizedStatmentSetter';
import {ProfileSetter} from './setters/profileSetter';
import {GuestModel} from './models/guestModel';
import {RegularUserModel} from './models/regularUserModel';
import {AdminModel} from './models/adminModel';
import {SessionModel} from './models/sessionModel';
import {User} from './user';
import {Session} from './session';
import {LocalStorage} from './localStorage';
import {UserFactory} from './factorys/userFactory';
import {CONFIG} from '../../config.js';
import {Logger} from './logger.js';

function commonBootstrap() {
    dic.add('UserFactory', function (...args) {
        return new UserFactory(...args);
    });
    dic.add('LocalStorage', function (...args) {
        return new LocalStorage(...args);
    });
    dic.add('User', function (...args) {
        return new User(...args);
    });
    dic.add('Session', function (...args) {
        return new Session(...args);
    });
    dic.add('GuestModel', function (...args) {
        return new GuestModel(...args);
    });
    dic.add('RegularUserModel', function (...args) {
        return new RegularUserModel(...args);
    });
    dic.add('AdminModel', function (...args) {
        return new AdminModel(...args);
    });
    dic.add('SessionModel', function (...args) {
        return SessionModel.getInstance();
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
    dic.add('AuthorizedStatmentSetter', function (...args) {
        return new AuthorizedStatmentSetter(...args);
    });
    dic.add('ProfileSetter', function (...args) {
        return new ProfileSetter(...args);
    });
    dic.add('CONFIG', function () {
        return CONFIG;
    });
    dic.add('Logger', function (...args) {
        return new Logger(...args);
    });
}