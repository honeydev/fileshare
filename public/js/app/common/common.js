export {common};

import 'bootstrap';
import 'dic';
import url from 'bootstrap/dist/css/bootstrap.min.css';
import style from '../../../css/styles.css';
import {commonBootstrap} from './commonBootstrap';
import {CommonHandlers} from './commonHandlers';
import {ProfileHandlers} from './profileHandlers';

let common = function () {
    commonBootstrap();
    let session = dic.get('Session')(dic);
    session.start();
    let commonHandlers = new CommonHandlers(dic);
    commonHandlers.setHandlers();
};

common();