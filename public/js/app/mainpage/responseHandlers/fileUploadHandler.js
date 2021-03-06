'use strict';

export {FileUploadHandler};

import {InvalidServerResponseError} from '../../common/errors/InvalidServerResponseError';

function FileUploadHandler(dic) {
    this._alertQueue = dic.get('AlertQueue')(dic);
    this._alertQueue.activate();
}
/**
 * @return {function}
 */
FileUploadHandler.prototype.getHandler = function () {
    return (response, textStatus, xhr) => {
        if (response.status === "success") {
            window.location.href = response.fileUrl;
        } else if (response.status === "failed") {
            this._alertQueue.add("Unknown server error", {type: 'danger'});
        } else {
            throw InvalidServerResponseError('Invalid server response');
        }
    }
};
