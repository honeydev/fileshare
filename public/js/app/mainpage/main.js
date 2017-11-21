'use strict';

import {common} from '../common/common';
import {MainPageHandlers} from './mainPageHandlers.js';

function mainPage() {
	let mainPageHandlers = new MainPageHandlers();
	mainPageHandlers.setHandlers();
}

common();
mainPage();