<?php

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $viewData = $c->get('settings')['appInfo'];
        $viewData['page'] = '404';
        $response = $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html');
        return $c->view->render(
            $response,
            "index.twig",
            $viewData
        );
    };
};