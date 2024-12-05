<?php

if (!($_SERVER["REQUEST_URI"])) {
    http_response_code(400);
    echo "Пустой запрос";
    die();
}

$arg = explode("/", $_SERVER["REQUEST_URI"]);

if ($arg[1] === "api") {

    $version = $arg[2];

    switch ($arg[3]) {
        case 'user':
            executeUserMethod($arg[4]);
            break;

        default:
            http_response_code(400);
            echo "Неверный запрос {$_SERVER["REQUEST_URI"]}";
            die();
            break;
    }
}

function executeUserMethod($arg)
{
    if ($_SERVER["REQUEST_METHOD"] === "GET") $arg = explode("?", $arg);
    switch ($arg[0]) {
        case 'authentication':
            include_once "api/v1/user/authentication.php";
            break;
        case 'create':
            include_once "api/v1/user/create.php";
            break;
        case 'delete':
            include_once "api/v1/user/delete.php";
            break;
        case 'read_one':
            include_once "api/v1/user/read_one.php";
            break;
        case 'read':
            include_once "api/v1/user/read.php";
            break;
        case 'update':
            include_once "api/v1/user/update.php";
            break;
        default:
            http_response_code(400);
            echo "Такого метода не существует $arg[0]";
            die();
            break;
    }
}
