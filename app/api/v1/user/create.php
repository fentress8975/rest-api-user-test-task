<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

echo "create";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->login) &&
    !empty($data->password) &&
    !empty($data->description)
) {
    $user->login = $data->name;
    $user->password = $data->price;
    $user->description = $data->description;

    if ($user->create()) {
        http_response_code(201);

        echo json_encode(array("message" => "Пользователь создан"));
    }
    else {
        http_response_code(503);

        echo json_encode(array("message" => "Невозможно создать пользователя"));
    }
}
else {
    http_response_code(400);

    echo json_encode(array("message" => "Невозможно создать пользователя. Нету необходимых данных"));
}
