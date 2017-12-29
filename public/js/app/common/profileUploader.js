'use strict';

export {ProfileUploader};

import {EmailValidError} from './errors/emailValidError';
import {NameValidError} from './errors/nameValidError';
import {PasswordValidError} from './errors/passwordValidError';

function ProfileUploader(dic) {
    this._emailValidator = dic.get('EmailValidator')();
    this._nameValidator = dic.get('NameValidator')();
    this._passwordValidator = dic.get('PasswordValidator')();
    this._profileFormSetter = dic.get('ProfileFormSetter')();
}
/**
 * @param  {object} profileForm [
 * @return {void}
 */
ProfileUploader.prototype.upload = function (profileForm) {
    try {
        console.log(profileForm);
        this._validateForm(profileForm);
    } catch (Error) {
        console.log('error', Error);
        if (Error instanceof EmailValidError) {
            console.log('email error');
            //this._profileFormSetter.setError(profileForm['profileEmailInput']);
        } else if (Error instanceof NameValidError) {
            console.log('name error');
        } else if (Error instanceof PasswordValidError) {
            console.log('password error');
        }
    }
};

ProfileUploader.prototype._validateForm = function (profileForm) {
    console.log('inputs to validate', profileForm);
    const VALIDATORS_MAP = {
        'profileEmailInput': 'emailValidator',
        'profileNameInput': 'nameValidator',
        'profileCurrentPassowrdInput': 'passwordValidator',
        'profileNewPasswordInput': 'passwordValidator',
        'profileNewPasswordRepeatInput': 'passwordValidator'
    };
    console.log('pre cycle', $(profileForm['profileEmailInput']).val());
    let validatorName, validator, valueToValidate;
    for (let input in profileForm) {
        console.log(profileForm[input]);
        validatorName = '_' + VALIDATORS_MAP[input];
        validator = this[validatorName];
        valueToValidate = $(profileForm[input]).val();
        this[validatorName].validate(valueToValidate);
        console.log('validator name', validatorName, 'validator', validator, 'value to validate', valueToValidate);
    }
    console.log('validate end');
};
