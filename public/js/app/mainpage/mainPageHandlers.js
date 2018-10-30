'use strict';

export {MainPageHandlers};

function MainPageHandlers(dic) {
    this._dic = dic;
    this._fileForm = dic.get("FileForm")(dic);
    this._uploadSectionSetter = dic.get('UploadSectionSetter')(dic);
}

MainPageHandlers.prototype.setHandlers = function () {
    this._setDragNDropHandlers();
    this._setUploadFileHandler();
    this._setUploadButtonHandler();
};

MainPageHandlers.prototype._setDragNDropHandlers = function () {

    $("#dndWrap").bind('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this._fileForm.send(e.originalEvent.dataTransfer.files[0]);
        this._uploadSectionSetter.unsetDragNDropStyles();
    });

    $("header, main").bind('dragover', (e) => {
        e.preventDefault();
        this._uploadSectionSetter.setDragNDropStyles();
        $("#dndWrap").bind('dragover', (e) => {
            e.preventDefault();
        });
    });

    $('#dndWrap').bind('dragleave', (e) => {
        e.preventDefault();
        this._uploadSectionSetter.unsetDragNDropStyles();
    });
};

MainPageHandlers.prototype._setUploadFileHandler = function() {

    $('#inputFile').bind('change', (e) => {
        this._fileForm.send($('#inputFile').prop('files')[0]);
    });
};

MainPageHandlers.prototype._setUploadButtonHandler = function() {
    $('#uploadButton').click((e) => {
        e.preventDefault();
        e.stopPropagation();
        $("#inputFile").trigger('click');
    });
};