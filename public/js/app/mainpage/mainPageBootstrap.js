'use strict';

export {mainPageBootstrap};

import {dic} from 'dic';
import {FileUploader} from './fileUploader';
import {FileValidator} from './fileValidator';
import {UploadSectionSetter} from './uploadSectionSetter';
import {FileForm} from './fileForm';
import {FileFormSetter} from './setters/fileFormSetter';
import {ProgressBar} from "./progressBar";
import {FileUploadHandler} from "./responseHandlers/fileUploadHandler";
import {UploadErrorHandler} from './errorHandlers/uploadErrorHandler';

function mainPageBootstrap() {	
    dic.add('FileUploader', function (...args) {
        return new FileUploader(...args);
    });
    dic.add('FileValidator', function (...args) {
        return new FileValidator(...args);
    });
    dic.add('UploadSectionSetter', function (...args) {
        return new UploadSectionSetter(...args);
    });
    dic.add("FileForm", function (...args) {
        return new FileForm(...args);
    });
    dic.add("FileFormSetter", function (...args) {
        return new FileFormSetter(...args);
    });
    dic.add("ProgressBar", function (...args) {
        return new ProgressBar(...args);
    });
    dic.add("FileUploadHandler", function (...args) {
        return new FileUploadHandler(...args);
    });
    dic.add('UploadErrorHandler', function (...args) {
        return new UploadErrorHandler(...args);
    })
}