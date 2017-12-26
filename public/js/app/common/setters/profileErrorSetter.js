'use strict';

export {ProfileErrorSetter};

function ProfileErrorSetter() {
   
}

ProfileErrorSetter.prototype.setError = function (message) {
    let errorElement = this._renderMessage(message);
    this._cleanMessage(errorElement)
};

ProfileErrorSetter.prototype._renderMessage = function (message) {
    let error = $('<div>').attr({
        'class': 'alert alert-danger',
        'id': 'profileErrorMessage'
    }).text(message);
    $("#profileModalBody").prepend(error);
    return error;
};

ProfileErrorSetter.prototype._cleanMessage = function (errorElement) {
    setTimeout(() => {
        $(errorElement).remove();
    }, 4000);
};