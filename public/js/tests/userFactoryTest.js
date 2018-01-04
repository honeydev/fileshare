'use strict';

export {UserFactoryTest};

import {assert} from 'chai';

function UserFactoryTest(dic) {
    this._dic;
    this._userFactory = dic.get('UserFactory')(dic);
}

UserFactoryTest.prototype.test = function () {
    this._createUsers();
};

UserFactoryTest.prototype._createUsers = function () {
    describe(`Create different user objects`, () => {
        it(`create GuestModel`, () => {
            const USER_DATA = {
                accessLvl: 0
            };
            let user = this._userFactory.create(0, USER_DATA);
            assert.equal(user.constructor.name, "GuestModel");
        });
        it(`create RegularUserModel`, () => {
            const USER_DATA = {
                accessLvl: 1,
                email: "email@email.com",
                name: "name",
                avatarUri: null,
                id: "14"
            };
            let user = this._userFactory.create(1, USER_DATA);
            assert.equal(user.constructor.name, "RegularUserModel");
            this._checkEqualProps(USER_DATA, user);
        });
        it(`create AdminUserModel`, () => {
            const USER_DATA = {
                accessLvl: 2,
                email: "email@email.com",
                name: "name",
                avatarUri: null,
                id: "14"
            };
            let user = this._userFactory.create(2, USER_DATA);
            //if in contructor we write ParentConstructor.apply(this), 
            //prototype.name = "ParentConstructor" - not current function
            assert.equal(user.constructor.name, "RegularUserModel");
            this._checkEqualProps(USER_DATA, user);
        });
    });
};

UserFactoryTest.prototype._checkEqualProps = function (userData, userObject) {
    for (let prop in userData) {
        let propName = '_' + prop;
        assert.equal(userData[prop], userObject.get(propName));
    }
};
