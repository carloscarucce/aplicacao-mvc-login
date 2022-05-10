<?php
ini_set('display_errors', 1);
require __DIR__.'/../vendor/autoload.php';
(new \Corviz\Application(__DIR__.'/..'))->run();
