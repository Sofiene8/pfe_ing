<?php

chdir(__DIR__ . '/..');

$config = @include 'config.php';

if (empty($_SERVER['REQUEST_METHOD'])) {
    $_SERVER['REQUEST_METHOD'] = 'GET';
}
$_SERVER['REQUEST_URI'] = rtrim($config['BASEURL'], '/') . '/jobg8_outgoing/';
if (empty($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = $config['HTTPHOST'];
}
if (empty($_SERVER['REMOTE_ADDR'])) {
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
}
if (empty($_SERVER['SERVER_PROTOCOL'])) {
    $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
}

// лучше абсолютный путь чтоб небыло конфликтов
require_once __DIR__ . '/../' . 'index.php';