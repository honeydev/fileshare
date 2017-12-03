'use strict';

export {UploadSectionSetter};

function UploadSectionSetter() {

}

UploadSectionSetter.prototype.setDragNDropStyles = function () {
    console.log('set dndrop styles');
    $('#dndWrap').css("display", "block")
};

UploadSectionSetter.prototype.unsetDragNDropStyles = function () {
	$('#dndWrap').css('display', 'none');
};

UploadSectionSetter.prototype.setInvalidFileFormatModal = function () {
	$('#invalidFormatModal').modal('toggle');
};

UploadSectionSetter.prototype.setErrorUploadFlashMessage = function () {

};

UploadSectionSetter.prototype.setUploadFormBack = function () {

};