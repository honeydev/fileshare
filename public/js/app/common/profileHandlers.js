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
    $('#avatarUploadInput').change({profile: this._profile}, function () {
        e.data.profile.uploadAvatar();
    });
    $('.userDataEditIcon').click({profile: this._profile}, function (e) {
        console.log(e);
        e.data.profile.switchToForm();
    });
};