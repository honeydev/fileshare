'use strict';

export {FileFormSetter};

function FileFormSetter(dic) {

}

FileFormSetter.prototype.setUploadStatment = function () {
    this._removeFileInput();
    this._addProgressBar();
};

FileFormSetter.prototype._removeFileInput = function () {
    $("#inputFile").remove();
};
