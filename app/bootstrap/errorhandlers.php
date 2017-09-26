<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 11:01 PM
 */

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $container['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('sadasdadsaasdas');
    };
};