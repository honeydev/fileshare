'use strict';

export {AuthorizedStatmentSetter};

function AuthorizedStatmentSetter() {

}

AuthorizedStatmentSetter.prototype.setAuthorized = function () {
    $('#logOutA').css("display", "block");
    $('#loginA').css("display", "none");
    $('#registerA').css("display", "none");
    $('#profileA').css("display", "block");
};
