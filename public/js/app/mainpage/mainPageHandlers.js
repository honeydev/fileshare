/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {MainPageHandlers};

function MainPageHandlers(dic) {
    this._dic = dic;
    this._fileUploader = dic.get('FileUploader')(dic);
    this._uploadSectionSetter = dic.get('UploadSectionSetter')(dic);
    console.log('uploadSetter', this._uploadSectionSetter);
}

MainPageHandlers.prototype.setHandlers = function () {
    this._setDragNDropHandlers();
    this._setUploadFileHandler();
};


MainPageHandlers.prototype._setDragNDropHandlers = function () {

    $("#dndWrap").bind('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this._fileUploader.uploadFile(e.originalEvent.dataTransfer.files[0]);
        this._uploadSectionSetter.unsetDragNDropStyles();
        console.log('drop');
    });

    $("header, main").bind('dragover', (e) => {
        e.preventDefault();
        console.log('dragover');
        this._uploadSectionSetter.setDragNDropStyles();
        $("#dndWrap").bind('dragover', (e) => {
            e.preventDefault();
        });
    });

    $('#dndWrap').bind('dragleave', (e) => {
        e.preventDefault();
        console.log('dragleave');
        this._uploadSectionSetter.unsetDragNDropStyles();
    });


};

MainPageHandlers.prototype._setUploadFileHandler = function() {

    $('#inputFile').bind('change', (e) => {
        this._fileUploader.uploadFile($('#inputFile').prop('files')[0]);
    });
};