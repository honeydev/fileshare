'use strict';

export {ProfileButtonSetter};

function ProfileButtonSetter() {

}

ProfileButtonSetter.prototype.haveChanges = function () {
    this._showApply();
    this._showCancel();
    this._hideChange();
};

ProfileButtonSetter.prototype.dontHaveChanges = function () { 
    this._hideCancel();
    this._hideApply();
    this._showChange();
};

ProfileButtonSetter.prototype._showChange = function () {
    $('#changeProfileButton').css('display', 'inline');
};

ProfileButtonSetter.prototype._hideChange = function () {
    $('#changeProfileButton').css('display', 'none');
};

ProfileButtonSetter.prototype._showCancel = function () {
    $('#cancelPorfileButton').css('display', 'inline');
};

ProfileButtonSetter.prototype._hideCancel = function () {
    $('#cancelPorfileButton').css('display', 'none');
};

ProfileButtonSetter.prototype._showApply = function () {
	$('#applyProfileButton').css('display', 'inline');
};

ProfileButtonSetter.prototype._hideApply = function () {
	$('#applyProfileButton').css('display', 'none');
};