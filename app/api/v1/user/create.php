<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "php/database.php";
include_once "api/v1/objects/user.php";


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents('php://input'), true);


if (
    !empty($data['login']) &&
    !empty($data['password']) &&
    !empty($data['description'])
) {
    $user->login = $data['login'];
    $user->password = $data['password'];
    $user->description = $data['description'];

    if ($user->create()) {
        http_response_code(201);

        echo json_encode(array("message" => "Пользователь создан"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "Невозможно создать пользователя"));
    }
} else {
    http_response_code(400);

    echo json_encode(array("message" => "Невозможно создать пользователя. Нету необходимых данных"));
}
