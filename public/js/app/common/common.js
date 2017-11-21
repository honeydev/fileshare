/**
 * Created by honey on 26/10/17.
 */

export {common};

import 'bootstrap';
import 'dic';
import url from 'bootstrap/dist/css/bootstrap.min.css';
import style from '../../../css/styles.css';
import {commonBootstrap} from './commonBootstrap.js';
import {CommonHandlers} from './commonHandlers.js';


let common = function() {
    commonBootstrap();
    let handlers = new CommonHandlers(dic);
    handlers.setHandlers();
};