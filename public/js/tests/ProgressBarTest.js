'use strict';

export {ProgressBarTest};

import {BaseTest} from './baseTest';
import {bar} from '../app/mainpage/templates/progressBar';
import assert from 'chai';

function ProgressBarTest(dic) {
    this._progressBar = dic.get("ProgressBar")(dic);
}

ProgressBarTest.prototype = Object.create(BaseTest.prototype);
ProgressBarTest.prototype.constructor = ProgressBarTest;

ProgressBarTest.prototype.test = function () {
    let context = this;
    $("body").append(bar);
    describe("Test progress bar", function () {
        it("Set progress values", function () {
            context._progressBar.setProgress(40);
            assert.assert.equal($("#progressBar").attr("aria-valuenow"), 40);
            assert.assert.equal($("#progressBar").text(), "40%");
        });
        after(() => {
            context._removeDomEnv('#progressBar');
        });
    });
};