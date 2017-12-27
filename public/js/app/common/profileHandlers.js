'use strict';

export {ProfileHandlers};

function ProfileHandlers(dic) {
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._profile = dic.get('Profile')(dic);
}

ProfileHandlers.prototype.setHandlers = function () {
    console.log('set profile handlers');
    this.setEditDataIcons();
    this._setAvatarHandlers();
    this._closeProfile();
    this._cancelProfile();
    this._changeProfile();
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
    $('#uploadAvatarA').click(function () {
        $('#avatarUploadInput').trigger('click');
    });
    $('#avatarUploadInput').change({profile: this._profile}, function (e) {
        e.data.profile.setAvatarPreview($(this)[0].files[0]);
        $(this).val(null);
    });
};

ProfileHandlers.prototype._closeProfile = function () {
    $('#profileClose, #cancelPorfileButton').click(function (e) {
        console.log('close modal');
    });
};

ProfileHandlers.prototype._cancelProfile = function () {
    $('#cancelPorfileButton').click({profile: this._profile}, function (e) {
        console.log('switch to Profile');
        e.data.profile.switchToProfile();
    });
};

ProfileHandlers.prototype._changeProfile = function () {
    $('#changeProfileButton').click({profile: this._profile}, function (e) {
        console.log('apply changes');
        e.data.profile.applyChanges();
    });
};