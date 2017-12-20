'use strict';

export {ProfileHandlers};

function ProfileHandlers(dic) {

}

ProfileHandlers.prototype.setHandlers = function () {
    $('#userDataList > ul').mouseover(function () {
        $(this).find(".userDataEditIcon").css('display', 'inline');
    });

    $('#userDataList > ul').mouseleave(function () {
        $(this).find(".userDataEditIcon").css('display', 'none');
    });
};