'use strict';

export {FileValidatorTest};

import {assert} from 'chai';
import {FileValidator} from '../app/mainpage/fileValidator.js';

function FileValidatorTest(dic) {
    this._allowExtensions = {
        image: ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico'],
        videos: ['mp4', 'avi', 'wmv', 'mov', 'mkv', '3gp', 'flw', 'swf'],
        audio: ['mp3', 'wav', 'wave', 'acc', 'ogg'],
        // archive: ['7z', 'gz', 'rar', 'tar', 'tar-gz', 'tar.gz', 'zip', 'cbr']
    };
    this._fileValidator = new FileValidator(dic);
}

FileValidatorTest.prototype.test = function () {
    this._checkFileName();
};

FileValidatorTest.prototype._checkFileName = function () {

    describe('Add files with correct fileName', () => {
        it (`Try iterate array with correct names, 
            everyone should return true`, () => {

            const CORRECT_FILENAMES = this._generateCorrectFiles();

            CORRECT_FILENAMES.forEach((file) => {
                assert.isTrue(this._fileValidator.validate(file));
            });
        });
    });

    describe('Add files with incorrect filename', () => {
        it(`Try iterate array with incorrect names`, () => {
            const INCORRECT_FILES = this._generateIncorrectFiles();
            INCORRECT_FILES.forEach((file) => {
                assert.throws(() => {return this._fileValidator.validate(file)}, `Incorrect extension file ${file.name}`);
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
    const DO_NAME_INCORRECT_METHODS = this._getIncorrectNameCreateMethods();

    for (let extensions in this._allowExtensions) {
        this._allowExtensions[extensions].forEach((ext) => {
            let incorrectMethodName = DO_NAME_INCORRECT_METHODS[
                Math.floor(Math.random() * DO_NAME_INCORRECT_METHODS.length)
            ];
            incorrectFiles.push({
                name: incorrectMethodName(ext)
            });
        });
    }
    return incorrectFiles;
};

FileValidatorTest.prototype._getIncorrectNameCreateMethods = function () {
    return [
        function (ext) {
            ext = this._addSpacesInExt(ext);
            return 'incorrect_name with space after dot. ' + ext;
        }.bind(this),
        function (ext) {
            return 'incorect_name with.' + ext + 'text after extension';
        }
    ];
};

FileValidatorTest.prototype._addSpacesInExt = function (ext) {
    return ext.replace(/\./gi, '. ');
};
