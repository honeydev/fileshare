'use strict';

import {common} from '../common/common';
import {mainPageBootstrap} from './mainPageBootstrap';
import {MainPageHandlers} from './mainPageHandlers';

function mainPage() {
    mainPageBootstrap();
    let mainPageHandlers = new MainPageHandlers(dic);
    mainPageHandlers.setHandlers();
}

mainPage();