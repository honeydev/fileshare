'use strict';

export {Debugger};

function Debugger(dic) {
    this._debug = dic.get('CONFIG')()['debug'];
    this._WINDOW_SETTINGS = {
        width: 300,
        height: 300
    };
}

Debugger.prototype.openDebugger = function (output) {
    if (this._debug) {
        let debugWindow = window.open(null, 'Debugger', this._WINDOW_SETTINGS);
        debugWindow.document.write(output);
    }
};