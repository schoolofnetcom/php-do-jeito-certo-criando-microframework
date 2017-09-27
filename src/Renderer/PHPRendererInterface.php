<?php

namespace ErikFig\Renderer;

interface PHPRendererInterface
{
    public function setData($data);
    public function run();
}
