'use strict';

export {mainPageBootstrap};

import {DragNDropUploader} from './dragNDropUploader';

function mainPageBootstrap(dic) {
    dic.add('DragNDropUploader', function(...args) {
        return new DragNDropUploader(...args);
    });
}