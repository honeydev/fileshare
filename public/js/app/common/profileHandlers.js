'use strict';

export {ProfileHandlers};

function ProfileHandlers(dic) {
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._profile = dic.get('Profile')(dic);
}

ProfileHandlers.prototype.setHandlers = function () {
    this.setEditDataIcons();
    this._setAvatarHandlers();
    this._closeProfile();
    this._cancelProfile();
    this._changeProfile();
    this._applyProfile();
};

ProfileHandlers.prototype.setEditDataIcons = function () {
    $('#userDataList > li').mouseover({profileSetter: this._profileSetter}, function (e) {
        e.data.profileSetter.showUserDataEditIcon(this);
    });
    $('#userDataList > li').mouseleave({profileSetter: this._profileSetter}, function (e) {
        e.data.profileSetter.hideUserDataEditIcon(this)
    });
    $('.userDataEditIcon').click({profile: this._profile}, function (e) {
        console.log(e);
        e.data.profile.switchToForm();
    });
};

ProfileHandlers.prototype._setAvatarHandlers = function () {
    $('#uploadAvatarAInProfile, #uploadAvatarAInForm').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#avatarUploadInput').trigger('click');
    });
    $('#avatarUploadInput').change({profile: this._profile}, function (e) {
        e.data.profile.setAvatarPreview($(this)[0].files[0]);
    });
};

ProfileHandlers.prototype._closeProfile = function () {
    $('#profileClose').click(function (e) {
        //empty handler
    });
};

ProfileHandlers.prototype._cancelProfile = function () {
    $('#cancelPorfileButton').click({profile: this._profile}, function (e) {
        e.data.profile.switchToProfile();
    });
};

ProfileHandlers.prototype._changeProfile = function () {
    $('#changeProfileButton').click({profile: this._profile}, function (e) {
        e.data.profile.switchToForm();
    });
};

ProfileHandlers.prototype._applyProfile = function () {
    $('#applyProfileButton').click({profile: this._profile}, function (e) {
        e.data.profile.applyChanges();
    });
};