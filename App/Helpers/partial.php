<?php

use Core\View;

function partial(string $path)
{
    return (new View())->load($path);
}
