<?php

function a($arg)
{
    return var_dump($arg);
}
$b = a(function () {
    return 'saya';
});
echo $b;
