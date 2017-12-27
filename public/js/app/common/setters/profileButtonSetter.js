'use strict';

export {ProfileButtonSetter};

function ProfileButtonSetter() {

}

ProfileButtonSetter.prototype.showButtons = function () {
    this._showChange();
    this._showCancel();
};

ProfileButtonSetter.prototype.hideButtons = function () {
    this._hideChange();
    this._hideCancel();
};

ProfileButtonSetter.prototype._showChange = function () {
    $('#cancelPorfileButton').css('display', 'inline');
};

ProfileButtonSetter.prototype._hideChange = function () {
    $('#cancelPorfileButton').css('display', 'none');
};

ProfileButtonSetter.prototype._showCancel = function () {
    $('#changeProfileButton').css('display', 'inline');
};

ProfileButtonSetter.prototype._hideCancel = function () {
    $('#changeProfileButton ').css('display', 'none');
};
