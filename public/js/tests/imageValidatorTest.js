'use strict';

export {BaseTest};

import {assert} from 'chai';
import {ImageValidator} from '../app/common/validators/imageValidator.js';
import {bootstrap} from './bootstrap';

function ImageValidatorTest(dic) {
    this._imageValidator = new ImageValidator();
}

ImageValidatorTest.prototype.test = function () {
    this._testMimeType();
};

ImageValidatorTest.prototype._testMimeType = function () {
    const MIME_TYPES = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'];
    describe(`Check correct files with mime type`, () => {
        it(`test jpeg`, () => {
            let jpg = new Blob(null, {type: "image/jpeg"});
            console.log(jpg);
        });
    });
};

let imageValidatorTest = new ImageValidatorTest();
imageValidatorTest.test();