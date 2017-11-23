'use strict';

import {common} from '../common/common';
import {mainPageBootstrap} from './mainPageBootstrap';
import {MainPageHandlers} from './mainPageHandlers';

function mainPage() {
	mainPageBootstrap(dic);
	let mainPageHandlers = new MainPageHandlers(dic);
	console.log(mainPageHandlers._dragNDropUploader);
	mainPageHandlers.setHandlers();
}

common();
mainPage();