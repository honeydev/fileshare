'use strict';

export {BaseTest};

import {assert} from 'chai';
import {FileValidator} from '../app/mainpage/fileValidator.js';

function FileValidatorTest() {
    this._allowExtensions = {
        image: ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico'],
        videos: ['mp4', 'avi', 'wmv', 'mov', 'mkv', '3gp', 'flw', 'swf'],
        audio: ['mp3', 'wav', 'wave', 'acc', 'ogg'],
        archive: ['7z', 'gz', 'rar', 'tar', 'tar-gz', 'tar.gz', 'zip', 'cbr']
    };
    this._fileValidator = new FileValidator();
}

FileValidatorTest.prototype.validate = function () {
    this._checkFileName();
};

FileValidatorTest.prototype._checkFileName = function () {

    describe('Add files with correct fileName', () => {
        it (`Try iterrate array with correct names, 
            everyone should return true`, () => {

            const CORRECT_FILENAMES = this._generateCorrectFiles();

            CORRECT_FILENAMES.forEach((file) => {
                assert.isTrue(this._fileValidator.validate(file));
            });
        });
    });
};

FileValidatorTest.prototype._generateCorrectFiles = function () {
    let correctFiles = [];

    for (let extensions in this._allowExtensions) {      
        this._allowExtensions[extensions].forEach((ext) => {
            correctFiles.push({
                name: 'correct file name.' + ext
            });
        });   
    }

    return correctFiles;
};

FileValidatorTest.prototype._generateIncorrectFiles = function () {
    let incorrectFiles = [];
};

let fileValidatorTest = new FileValidatorTest();
fileValidatorTest.validate();