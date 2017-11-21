/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {MainPageHandlers};

function MainPageHandlers(dic) {
    this._dic = dic;
    this._dragNDropUploader = dic.get('DragNDropUploader')(dic);
    console.log('drag', dic, this._dragNDropUploader);
}

MainPageHandlers.prototype.setHandlers = function () {

    this._setDragNDropHandlers();
};


MainPageHandlers.prototype._setDragNDropHandlers = function () {

    $('#uploadSection').bind('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this._dragNDropUploader.uploadFile(e.originalEvent.dataTransfer.files[0]);
        console.log('drop');
    });

    $('#uploadSection').bind('dragover', function (e) {
        e.preventDefault();
        console.log('dragover');
    });

    $('#uploadSection').bind('dragleave', function(e) {
        e.preventDefault();
        console.log('dragleave');
    });
};