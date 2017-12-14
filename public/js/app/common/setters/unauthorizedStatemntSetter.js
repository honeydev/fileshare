'use strict';

function UnauthorizedStatmentSetter() {

}

UnauthorizedStatmentSetter.prototype.setUnatuhorized = function() {
    $('#logOutA').css("display", "node");
    $('#loginA').css("display", "block");
    $('#registerA').css("display", "block");
};