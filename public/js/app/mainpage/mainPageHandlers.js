/**
 * Created by honey on 28/10/17.
 */

'use strict';

export {MainPageHandlers};

function MainPageHandlers(dic) {
    this._dic = dic;
}

MainPageHandlers.prototype.setHandlers = function() {
    console.log('set handlers');
    $( ".mainSpace" ).draggable({
        drag: function( event, ui ) {
            console.log('drag');
        }
    });
};