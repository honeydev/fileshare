/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {MainPageHandlers};

function MainPageHandlers(dic) {
    this._dic = dic;
    this._fileUploader = dic.get('FileUploader')(dic);
}

MainPageHandlers.prototype.setHandlers = function () {

    this._setDragNDropHandlers();
    this._setUploadFileHandler();
};


MainPageHandlers.prototype._setDragNDropHandlers = function () {

    $('#uploadSection').bind('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this._fileUploader.uploadFile(e.originalEvent.dataTransfer.files[0]);
        console.log('drop');
    });

    $('#uploadSection').bind('dragover', (e) => {
        e.preventDefault();
        console.log('dragover');
    });

    $('#uploadSection').bind('dragleave', (e) => {
        e.preventDefault();
        console.log('dragleave');
    });


};

MainPageHandlers.prototype._setUploadFileHandler = function() {

    $('#inputFile').bind('change', (e) => {
        this._fileUploader.uploadFile($('#inputFile').prop('files')[0]);
    });
};