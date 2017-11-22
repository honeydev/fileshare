'use strict';

export {mainPageBootstrap};

import {FileUploader} from './fileUploader';
import {FileValidator} from './fileValidator';

function mainPageBootstrap(dic) {	
    dic.add('FileUploader', function (...args) {
        return new FileUploader(...args);
    });
    dic.add('FileValidator', function (...args) {
    	return new FileValidator(...args);
    });
}