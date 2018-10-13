'use strict';

export {FileFormSetter};

import {bar} from '../templates/progressBar';

function FileFormSetter(dic) {

}

FileFormSetter.prototype.setUploadStatment = function () {
    this._removeFileInput();
    this._addProgressBar();
};

FileFormSetter.prototype._removeFileInput = function () {
    $("#inputFile").remove();
};

FileFormSetter.prototype._addProgressBar = function () {
    
};

