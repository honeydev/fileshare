'use strict';

export {FileUploadHandler};

function FileUploadHandler() {

}
/**
 * @return {function}
 */
FileUploadHandler.prototype.getHandler = function () {
    return (response) => {
        if (response.status === "success") {
            window.location.href = response.fileUrl;
        } else if (response.status === "failed") {

        }
    };
}