<?php

use React\EventLoop\Factory;
use React\Filesystem\Filesystem;

require_once __DIR__ . '/../../vendor/autoload.php';

$loop = Factory::create();
$filesystem = Filesystem::create($loop);

$file = $filesystem->file('test.txt');
$file->open('r')
    ->then(
        function ($stream) {
            $stream->on(
                'data',
                fn($chunk) => print 'Chunk read' . $chunk . PHP_EOL
            );
        }
    );

$loop->run();
