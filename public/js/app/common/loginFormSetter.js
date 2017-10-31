/**
 * Created by honey on 31/10/17.
 */

'use strict';

export {LoginFormSetter};

function LoginFormSetter() {

}

LoginFormSetter.prototype.setError = function(error) {
    $('#loginEmailGroup').addClass('has-error has-feedback');
    $('#loginPasswordGroup').addClass('has-error has-feedback');
};

LoginFormSetter.prototype.cleanForm = function() {

};