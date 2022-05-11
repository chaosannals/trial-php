<?php

require dirname(__DIR__) . '/vendor/autoload.php';

function image_resize($source, $target)
{
    $path = __DIR__ . "/asset/$source";
    $dist = __DIR__ . "/output/$target.png";
    $output = dirname($dist);
    if (!is_dir($output)) {
        mkdir($output, 0777, true);
    }
    $data = image_limit($path);
    file_put_contents($dist, $data);
}

timing('20x180', function () {
    image_resize('20x180.jpg', '20x180');
});

timing('100x200', function () {
    image_resize('100x200.jpg', '100x200');
});

timing('180x20', function () {
    image_resize('180x20.png', '180x20');
});

timing('200x100', function () {
    image_resize('200x100.png', '200x100');
});

timing('200x1200', function () {
    image_resize('200x1200.png', '200x1200');
});

timing('250x250', function () {
    image_resize('250x250.jpg', '250x250');
});

timing('800x1200', function () {
    image_resize('800x1200.png', '800x1200');
});

timing('900x800', function () {
    image_resize('900x800.png', '900x800');
});

timing('1200x200', function () {
    image_resize('1200x200.jpg', '1200x200');
});

timing('1200x800', function () {
    image_resize('1200x800.jpg', '1200x800');
});
