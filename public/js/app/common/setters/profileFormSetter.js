'use strict';

export {ProfileFormSetter};

function ProfileFormSetter() {

}

ProfileFormSetter.prototype.switchToForm = function () {
    const PROFILE_FORM = this._createProfileForm(userData);
    $('#userDataList').remove();
    $('.userProfileSection').append(PROFILE_FORM);
};

ProfileFormSetter.prototype._createProfileForm = function (userData) {
    let form = $('<form>').attr({
        class: "form-horizontal",
        role: "form"
    });
    console.log('data on render form', userData);
    for (let key in userData) {
        let formSection = $('<div>').attr({
        	class: "form-group"
        });
        const ID = this._stringEditorHelper.toUpperCaseFirstWord(key);
        let label = $('<label>').attr({
            for: `profile${ID}Input`,
        }).text(key);
        let input = $('<input>').attr({
            type: "email",
            class: "form-control",
            id: ID,
            value: userData[key]
        });
        $(form).append(formSection);
        $(formSection).append(label);
        $(label).append(input);
    }

    return form;
};

ProfileFormSetter.prototype.switchBack = function () {

};