'use strict';

export {DragNDropUploader};

function DragNDropUploader(dic) {
    this._ajax = dic.get('Ajax')(dic);
}

DragNDropUploader.prototype.uploadFile = function (file) {
    this._ajax.sendFile(file, 'upload.file');
};