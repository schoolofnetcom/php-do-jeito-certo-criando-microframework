<?php

require __DIR__.'/vendor/autoload.php';

$app = new ErikFig\App;
$app->setRenderer(new ErikFig\Renderer\PHPRenderer);

$app->get('/hello/{name}', function ($params) {
    return "<h1>{$params[1]}</h1>";
});

$app->run();