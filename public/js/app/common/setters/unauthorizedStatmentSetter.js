'use strict';

export {UnauthorizedStatmentSetter};

function UnauthorizedStatmentSetter() {

}

UnauthorizedStatmentSetter.prototype.setUnatuhorized = function() {
    $('#logOutA').css("display", "none");
    $('#loginA').css("display", "block");
    $('#registerA').css("display", "block");
};