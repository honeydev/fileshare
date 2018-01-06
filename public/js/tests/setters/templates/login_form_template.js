'use strict';

export let loginFormTemplate = '';

const REQUEST = $.get('http://'+location.host, function () {
    const MAIN_PAGE = REQUEST.responseText;
    let loginForm = $(MAIN_PAGE).find('#loginModal');

    console.log(loginForm);
});
