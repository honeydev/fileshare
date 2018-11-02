'use strict';

export {ProfileProgressBarSetter};

function ProfileProgressBarSetter() {

}

ProfileProgressBarSetter.prototype.set = function () {
    let wrap = $('<div>')
        .attr('class', 'progress progress-striped active')
        .css({
            "margin-left": "30%",
            "width": "40%"
        });
    let bar = $('<div>').attr({
        class: "progress-bar",
        role: "progressbar",
        "aria-valuenow": "100"
    }).css({
        width: "100%"
    });
    let note = $('<span>').text('We complete changes!');

    $('#profileModalBody').append(wrap).append(bar).append(note);
};