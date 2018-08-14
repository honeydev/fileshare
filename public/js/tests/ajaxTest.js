'use strict';

export {AjaxTest}

import faker from 'faker';
import assert from 'chai';

function AjaxTest(dic) {
    this._ajax = dic.get('Ajax')(dic);
}

AjaxTest.prototype.test = function () {
    const context = this;
    describe("Try file upload request", function () {
        it("Get random image, and send on server", function () {
            const IMAGE_URL = faker.image.avatar();
            $.get({
                url: IMAGE_URL,
                success: (response) => {
                    context._ajax.sendFile({
                        "url": location.host + "/api/uploadfile/annonym.file",
                        "data": { 
                            file: new File([response], "image.jpg", { 
                                type: "image/jpeg", 
                            })
                        },
                        "headers": {
                            filename: "image.jpg"
                        },
                        "responseHandler": function (response) {
                            /*
                             * if response contain status key, then
                             * server prepare request success
                             */
                            assert.property(response, "status");
                            assert.property(response, "fileUrl");
                        }.bind(this)
                    })
                }
            });
        })
    });
};


