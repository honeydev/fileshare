'use strict';

export {ProgressBar};

import { bar } from './templates/progressBar';

function ProgressBar(dic) {

}

ProgressBar.prototype.activate = function () {
    $("#fileForm").empty();
    $("#fileForm").html(bar);
};

ProgressBar.prototype.setProgress = function () {

};