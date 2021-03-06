'use strict';

export {ProgressBar};

import { bar } from './templates/progressBar';

function ProgressBar(dic) {

}

ProgressBar.prototype.activate = function () {
    $("#uploadButtonWrap").empty();
    $("#uploadButtonWrap").html(bar);
};
/**
 * @param {int} progress
 */
ProgressBar.prototype.setProgress = function (progress) {
    $("#progressBar").attr("aria-valuenow", progress);
    $("#progressBar").css("width", `${progress}%`);
    $("#progressBar").text(`${progress}%`);
};