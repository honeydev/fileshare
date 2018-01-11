'use strict';

export {ProfileErrorSetter};

function ProfileErrorSetter() {
   
}

ProfileErrorSetter.prototype.setError = function (message) {
    let errorElement = this._renderMessage(message);
};

ProfileErrorSetter.prototype._renderMessage = function (message) {
    let error = $('<div>').attr({
        'class': 'alert alert-danger',
        'id': 'profileErrorMessage'
    }).text(message);
    $("#profileModalBody").prepend(error);
    return error;
};

ProfileErrorSetter.prototype.removeMessage = function (errorElement = "#profileErrorMessage", timeout = null) {
    if (timeout !== null) {
        setTimeout(() => {
            $(errorElement).remove();
        }, timeout);
    } else {
        $(errorElement).remove();
    }
};