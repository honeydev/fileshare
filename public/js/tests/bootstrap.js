'use strict';

export {bootstrap};

import {commonBootstrap} from '../app/common/commonBootstrap';
import {mocha} from 'mocha';
import {assert} from 'chai';
import url from 'mocha/mocha.css';
import {FileValidatorTest} from './fileValidatorTest';
import {SessionModelTest} from './sessionModelTest';
import {UserFactoryTest} from './userFactoryTest';
import {AuthorizedStatmentSetterTest} from './setters/authorizedStatmentSetterTest';
import {AjaxTest} from './ajaxTest';
import {LoginFormSetterTest} from './setters/loginFormSetterTest';
import {LoginFormTest} from './loginFormTest';
import {dic} from 'dic';

mocha.setup('bdd');
commonBootstrap();

let fileValidatorTest = new FileValidatorTest();
let sessionModelTest = new SessionModelTest();
let userFactoryTest = new UserFactoryTest(dic);
let ajaxTest = new AjaxTest(dic);
let loginFormTest = new LoginFormTest(dic);
// fileValidatorTest.test();
// sessionModelTest.test();
// userFactoryTest.test();
//authorizedStatmentSetterTest.test();
loginFormTest.test();
mocha.run();