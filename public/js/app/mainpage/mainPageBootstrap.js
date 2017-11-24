'use strict';

export {mainPageBootstrap};

import {FileUploader} from './fileUploader';
import {FileValidator} from './fileValidator';
import {UploadSectionSetter} from './uploadSectionSetter';

function mainPageBootstrap(dic) {	
    dic.add('FileUploader', function (...args) {
        return new FileUploader(...args);
    });
    dic.add('FileValidator', function (...args) {
    	return new FileValidator(...args);
    });
    dic.add('UploadSectionSetter', function (...args) {
    	return new UploadSectionSetter(...args);
    })
}