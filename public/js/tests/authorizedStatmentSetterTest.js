'use strict';

export {AuthorizedStatmentSetterTest};

import {assert} from 'chai';

function AuthorizedStatmentSetterTest(dic) {
    this._authorizedStatmentSetter = dic.get('AuthorizedStatmentSetter')();
}

AuthorizedStatmentSetterTest.prototype.test = function () {
    this._createDomEnv();
    this._checkElementsChange();
    this._removeDomEnv();
};

AuthorizedStatmentSetterTest.prototype._checkElementsChange = function () {
    describe(`set page authorized statment`, () => {
        it(`use setAuthorized method`, () => {
            this._authorizedStatmentSetter.setAuthorized();
            assert.equal($('#logOutA').css('display'), 'block');
            assert.equal($('#loginA').css('display'), 'none');
            assert.equal($('#registerA').css('display'), 'none');
            assert.equal($('#profileA').css('display'), 'block');
        });
    });
};

AuthorizedStatmentSetterTest.prototype._createDomEnv = function () {
    $('body').append(`            
        <div class="collapse navbar-collapse testNavBar" id="bs-example-navbar-collapse-1 testNav">
            <ul class="nav navbar-nav">
                <li>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Find file">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Search</button>
                         </span>
                        </div>
                    </form>
                </li>
                <li><a href="#">Browse Files</a></li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#profileModal" id="profileA">Profile</a>
                </li>
                <li><a href="#" data-toggle="modal" data-target="#registerModal" id="registerA">Register</a></li>
                <li><a href="#" data-toggle="modal" data-target="#loginModal" id="loginA">Log in</a></li>
                <li><a href="#" id="logOutA">Log out</a></li>
            </ul>
        </div>
    `);
};

AuthorizedStatmentSetterTest.prototype._removeDomEnv = function () {
    setTimeout(() => {
        $('.testNavBar').remove(); 
    }, 100);
};