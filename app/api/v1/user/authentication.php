<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "php/database.php";
include_once "api/v1/objects/user.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents('php://input'), true);


if (
    !empty($data['login']) &&
    !empty($data['password'])
) {
    $user->login = $data['login'];
    $user->password = $data['password'];

    if ($user->authentication()) {
        http_response_code(200);

        echo json_encode(array("message" => "Успешная авторизация"));
    } else {
        http_response_code(200);

        echo json_encode(array("message" => "Неверное имя или пароль."));
    }
} else {
    http_response_code(400);

    echo json_encode(array("message" => "Невозможно авторизоваться. Нету необходимых данных"));
}
