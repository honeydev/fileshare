'use strict';

export {bootstrap};

import {commonBootstrap} from '../app/common/commonBootstrap';
import {mocha} from 'mocha';
import {assert} from 'chai';
import url from 'mocha/mocha.css';
import {FileValidatorTest} from './fileValidatorTest';
import {SessionModelTest} from './sessionModelTest';
import {UserFactoryTest} from './userFactoryTest';
import {AuthorizedStatmentSetterTest} from './authorizedStatmentSetterTest';
import {dic} from 'dic';

mocha.setup('bdd');
commonBootstrap();

let fileValidatorTest = new FileValidatorTest();
let sessionModelTest = new SessionModelTest();
let userFactoryTest = new UserFactoryTest(dic);
let authorizedStatmentSetterTest = new AuthorizedStatmentSetterTest(dic);
// fileValidatorTest.test();
// sessionModelTest.test();
// userFactoryTest.test();
authorizedStatmentSetterTest.test();
mocha.run();