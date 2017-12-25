'use strict';

export {ProfileHandlers};

function ProfileHandlers(dic) {
    this._profileSetter = dic.get('ProfileSetter')(dic);
    this._profile = dic.get('Profile')(dic);
}

ProfileHandlers.prototype.setHandlers = function () {
    console.log('set profile handlers');
    $('#userDataList > ul').mouseover({profileSetter: this._profileSetter}, function (e) {
        e.data.profileSetter.showUserDataEditIcon(this);
    });
    $('#userDataList > ul').mouseleave({profileSetter: this._profileSetter}, function (e) {
        e.data.profileSetter.hideUserDataEditIcon(this)
    });
    $('#uploadAvatarA').click(function () {
        $('#avatarUploadInput').trigger('click');
    });
    $('#avatarUploadInput').change({profile: this._profile}, function (e) {
        e.data.profile.uploadAvatar($(this)[0].files[0]);
    });
    $('.userDataEditIcon').click({profile: this._profile}, function (e) {
        console.log(e);
        e.data.profile.switchToForm();
    });
    $('#profileClose, #cancelPorfileButton').click(function (e) {
        console.log('close modal');
        e.data.profile.switchToProfile();
    });
    $('#cancelPorfileButton').click(function (e) {
        console.log('switch to Profile');
        e.data.profile.switchToProfile();
    });
};