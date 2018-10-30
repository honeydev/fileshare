'use strict';

export {UploadSectionSetter};

function UploadSectionSetter() {

}

UploadSectionSetter.prototype.setDragNDropStyles = function () {
    $('#dndWrap').css("display", "block")
};

UploadSectionSetter.prototype.unsetDragNDropStyles = function () {
	$('#dndWrap').css('display', 'none');
};

UploadSectionSetter.prototype.setInvalidFileFormatModal = function () {
	$('#invalidFormatModal').modal('toggle');
};
