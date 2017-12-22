/**
 * Created by honey on 26/10/17.
 */

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
    let profileHandlers = new ProfileHandlers(dic);
    commonHandlers.setHandlers();
    profileHandlers.setHandlers();
};