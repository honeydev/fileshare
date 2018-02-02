'use strict';

export {ProfileDataCollector};

import {EmailValidError} from './errors/emailValidError';
import {NameValidError} from './errors/nameValidError';
import {PasswordValidError} from './errors/passwordValidError';
import {PasswordsNotEqualError} from './errors/passwordsNotEqualError';

function ProfileDataCollector(dic) {
    this._emailValidator = dic.get('EmailValidator')();
    this._nameValidator = dic.get('NameValidator')();
    this._passwordValidator = dic.get('PasswordValidator')();
    this._profileFailedStatmentSetter = dic.get('ProfileFailedStatmentSetter')(dic);
}
/**
 * @param  {object} profileForm [
 * @return {void}
 */
ProfileDataCollector.prototype.collect = function (userData) {
    try {
        console.log(userData);
        let profileInputs = this._selectInputsFromForm();
        let changedInputs = this._calculateUserDataDiff(userData, profileInputs);
        console.log('selected inputs', profileInputs);
        if (this._userWantChangePass(profileInputs)) {
            console.log('yeah user try change pass');
            changedInputs = this._selectPassword(profileInputs, changedInputs);
        }
        changedInputs = this._categorizeChangedInputs(changedInputs);
        this._validateInputs(changedInputs);
        const NEW_USER_DATA = this._prepareUserData(changedInputs);
        console.log('new user data', NEW_USER_DATA);
        return NEW_USER_DATA;
    } catch (Error) {
        console.log('error', Error);
        if (Error instanceof EmailValidError) {
            console.log('email error');
            this._profileFailedStatmentSetter.setFailedStatment('invalid_email');
        } else if (Error instanceof NameValidError) {
            console.log('name error');
            this._profileFailedStatmentSetter.setFailedStatment('invalid_name');
        } else if (Error instanceof PasswordValidError) {
            console.log('password error');
            this._profileFailedStatmentSetter.setFailedStatment('invalid_passwords');
        } else if (Error instanceof PasswordsNotEqualError) {
            console.log('password not equal');
            this._profileFailedStatmentSetter.setFailedStatment('passwords_not_equal');
        }
    }
};

ProfileDataCollector.prototype._selectInputsFromForm = function () {

    let profileInputs = $('#profileForm > .form-group > input');
    let profileInputsWithIdKeys = {
        'userData': null,
        'userPasswords': null
    };

    for (let input of profileInputs) {
        profileInputsWithIdKeys[$(input).attr('id')] = input;
    }

    return profileInputsWithIdKeys;
};
/**
 * @param  {object}
 * @return {object}
 */
ProfileDataCollector.prototype._calculateUserDataDiff = function (userData, profileInputs, changedInputs = {}) {

    if ($(profileInputs['profileEmailInput']).val() != userData['email']) {
        changedInputs['profileEmailInput'] = profileInputs['profileEmailInput'];
    }

    if ($(profileInputs['profileNameInput']).val() != userData['name']) {
        changedInputs['profileNameInput'] = profileInputs['profileNameInput'];
    }

    return changedInputs;
};
/**
 * @param  {object} profileInputs
 * @param  {Object} changedInputs
 * @return {object}
 */
ProfileDataCollector.prototype._selectPassword = function (profileInputs, changedInputs = {}) {
    changedInputs['profileCurrentPasswordInput'] = profileInputs['profileCurrentPasswordInput'];
    changedInputs['profileNewPasswordInput'] = profileInputs['profileNewPasswordInput'];
    changedInputs['profileNewPasswordRepeatInput'] = profileInputs['profileNewPasswordRepeatInput'];

    return changedInputs;
};
/**
 * if some one password field not empty - user want change password
 * @param  {object}
 * @return {bool}
 */
ProfileDataCollector.prototype._userWantChangePass = function (profileInputs) {
    let currentPasswordVal = $(profileInputs['profileCurrentPasswordInput']).val();
    let newPasswordVal = $(profileInputs['profileNewPasswordInput']).val();
    let repeatNewPasswordVal = $(profileInputs['profileNewPasswordRepeatInput']).val();
    
    if (currentPasswordVal !== "" && currentPasswordVal !== null && currentPasswordVal !== undefined) {
        return true;
    }

    if (newPasswordVal !== "" && newPasswordVal !== null && newPasswordVal !== undefined) {
        return true;
    }

    if (repeatNewPasswordVal !== "" && repeatNewPasswordVal !== null && repeatNewPasswordVal !== undefined) {
        return true;
    }

    return false;
};
/**
 * @param  {object} changedInputs
 * @return {object}
 */
ProfileDataCollector.prototype._categorizeChangedInputs = function (changedInputs) {
    console.log('inputs pre categorize', changedInputs);
    const PASSWORDS_INPUTS_ID = [
        'profileCurrentPasswordInput', 
        'profileNewPasswordInput',
        'profileNewPasswordRepeatInput'
        ];
    let categorizedChangedInputs = {'userData': {}, 'userPasswords': {}};

    for (let inputId in changedInputs) {
        console.log('sort item', inputId);
        if (PASSWORDS_INPUTS_ID.indexOf(inputId) !== -1) {
            categorizedChangedInputs['userPasswords'][inputId] = changedInputs[inputId];
        } else {
            categorizedChangedInputs['userData'][inputId] = changedInputs[inputId];
        }
    }
    return categorizedChangedInputs;
};

ProfileDataCollector.prototype._validateInputs = function (profileInputs) {
    console.log('inputs to validate', profileInputs);
    const VALIDATORS_MAP = {
        'profileEmailInput': 'emailValidator',
        'profileNameInput': 'nameValidator',
        'profileCurrentPasswordInput': 'passwordValidator',
        'profileNewPasswordInput': 'passwordValidator',
        'profileNewPasswordRepeatInput': 'passwordValidator'
    };
    const validate = (elementList) => {
        console.log('element list', elementList);
        let validatorName, validator, valueToValidate;

        if (elementList.hasOwnProperty('profileNewPasswordInput')) {
            this._passwordValidator.checkEqual(
                $(elementList['profileNewPasswordInput']).val(),
                $(elementList['profileNewPasswordRepeatInput']).val()
                );
        }

        for (let input in elementList) {
            validatorName = '_' + VALIDATORS_MAP[input];
            validator = this[validatorName];
            valueToValidate = $(elementList[input]).val();
            console.log('input', input, 'validator name', validatorName, 'validator', validator, 'value to validate', valueToValidate);
            this[validatorName].validate(valueToValidate);
        }
    };

    validate(profileInputs['userData']);
    validate(profileInputs['userPasswords']);
    console.log('validate end');
};

ProfileDataCollector.prototype._prepareUserData = function (inputs) {
    console.log('inputs in prepare user data', inputs);
    const USER_DATA_KEYS_MAP = {
        'profileEmailInput': 'email',
        'profileNameInput': 'name',
        'profileCurrentPasswordInput': 'currentPassword',
        'profileNewPasswordInput': 'newPassword',
        'profileNewPasswordRepeatInput': 'repeatNewPassword'
    };

    let userData = {};

    const addInputValueToUserData = (elementList) => {
        for (let input in elementList) {
            userData[USER_DATA_KEYS_MAP[input]] = $(elementList[input]).val();
        }
    };

    addInputValueToUserData(inputs['userData']);
    addInputValueToUserData(inputs['userPasswords']);

    return userData;
};