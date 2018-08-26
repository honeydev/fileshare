'use strict';

export {bootstrap};

import 'dic';
import {commonBootstrap} from '../app/common/commonBootstrap';
import {mainPageBootstrap} from '../app/mainpage/mainPageBootstrap';
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
import {RegisterFormTest} from './registerFormTest';
import {RegisterFormSetterTest} from './setters/registerFormSetterTest';
import {ProfileDataCollectorTest} from './profileDataCollectorTest';
import {ProfileFailedStatmentSetterTest} from './setters/profileFailedStatmentSetterTest';
import {ProgressBarTest} from './ProgressBarTest';
import {AlertQueueTest} from './alertQueueTest';
import {AlertTest} from './alertTest';
import {AjaxTest} from './ajaxTest';
import {dic} from 'dic';

let tests = {};
mocha.setup('bdd');
commonBootstrap();
mainPageBootstrap();

// tests['fileValidatorTest'] = new FileValidatorTest(dic);
tests['sessionModelTest'] = new SessionModelTest(dic);
tests['userFactoryTest'] = new UserFactoryTest(dic);
tests['loginFormTest'] = new LoginFormTest(dic);
tests['registerFormTest'] = new RegisterFormTest(dic);
tests['loginFormSetterTest'] = new LoginFormSetterTest(dic);
tests['registerFormSetterTest'] = new RegisterFormSetterTest(dic);
tests['profileDataCollectorTest'] = new ProfileDataCollectorTest(dic);
tests['profileFailedStatmentSetterTest'] = new ProfileFailedStatmentSetterTest(dic);
tests['progressBarTest'] = new ProgressBarTest(dic);
tests['ajaxTest'] = new AjaxTest(dic);
tests['alertTest'] = new AlertTest(dic);
tests['alertQueueTest'] = new AlertQueueTest(dic);

if (TEST_NAME === 'all') {
    for (let test in tests) {
        tests[test].test();
    }
} else if (tests.hasOwnProperty(TEST_NAME)) {
    tests[TEST_NAME].test();
} else {
    alert(`Test ${TEST_NAME} not found`);
}

mocha.run();