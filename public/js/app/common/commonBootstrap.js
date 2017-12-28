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
import {UnauthorizedStatmentSetter} from './setters/unauthorizedStatmentSetter';
import {ProfileSetter} from './setters/profileSetter';
import {ProfileFormSetter} from './setters/profileFormSetter';
import {GuestModel} from './models/guestModel';
import {RegularUserModel} from './models/regularUserModel';
import {AdminModel} from './models/adminModel';
import {SessionModel} from './models/sessionModel';
import {User} from './user';
import {Session} from './session';
import {LocalStorage} from './localStorage';
import {UserFactory} from './factorys/userFactory';
import {CONFIG} from '../../config';
import {Logger} from './logger';
import {Logout} from './logout';
import {Profile} from './profile';
import {PropertyHelper} from './helpers/propertyHelper';
import {StringEditorHelper} from './helpers/stringEditorHelper';
import {ProfileHandlers} from './profileHandlers';
import {ImageValidator} from './validators/imageValidator';
import {ProfileErrorSetter} from './setters/profileErrorSetter';
import {ProfileButtonSetter} from './setters/profileButtonSetter';
import {ProfileUploader} from './profileUploader';

function commonBootstrap() {
    dic.add('CONFIG', function () {
        return CONFIG;
    });
    /** models */
    dic.add('User', function (...args) {
        return new User(...args);
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
    dic.add('SessionModel', function () {
        return SessionModel.getInstance();
    });
    /** services */
    dic.add('ProfileUploader', function (...args) {
        return new ProfileUploader(...args);
    });
    dic.add('Profile', function (...args) {
        return new Profile(...args);
    });
    dic.add('LocalStorage', function (...args) {
        return new LocalStorage(...args);
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
    dic.add('Logger', function (...args) {
        return new Logger(...args);
    });
    dic.add('Logout', function (...args) {
        return new Logout(...args);
    }); 
    dic.add('Session', function (...args) {
        return new Session(...args);
    });
    /**  validators */
    dic.add('EmailValidator', function (...args) {
        return new EmailValidator(...args);
    });
    dic.add('PasswordValidator', function (...args) {
        return new PasswordValidator(...args);
    });
    dic.add('NameValidator', function (...args) {
        return new NameValidator(...args);
    });
    dic.add('ImageValidator', function (...args) {
        return new ImageValidator(...args);
    });
    dic.add('LoginFormSetter', function (...args) {
        return new LoginFormSetter(...args);
    });
    /** setters */
    dic.add('RegisterFormSetter', function (...args) {
        return new RegisterFormSetter(...args);
    });
    dic.add('AuthorizedStatmentSetter', function (...args) {
        return new AuthorizedStatmentSetter(...args);
    });
    dic.add('UnauthorizedStatmentSetter', function (...args) {
        return new UnauthorizedStatmentSetter(...args);
    });
    dic.add('ProfileSetter', function (...args) {
        return new ProfileSetter(...args);
    });
    dic.add('ProfileFormSetter', function (...args) {
        return new ProfileFormSetter(...args);
    });
    dic.add('ProfileErrorSetter', function (...args) {
        return new ProfileErrorSetter(...args);
    });
    dic.add('ProfileButtonSetter', function (...args) {
        return new ProfileButtonSetter(...args);
    });
    /** factorys */
    dic.add('UserFactory', function (...args) {
        return new UserFactory(...args);
    });
    /* helpers */
    dic.add('PropertyHelper', function (...args) {
        return new PropertyHelper(...args);
    });
    dic.add('StringEditorHelper', function (...args) {
        return new StringEditorHelper(...args);
    });

    dic.add('ProfileHandlers', function (...args) {
        return new ProfileHandlers(...args);
    });
}