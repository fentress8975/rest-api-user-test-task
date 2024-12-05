<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once "php/database.php";
include_once "api/v1/objects/user.php";


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_GET["id"]) ? $_GET["id"] : die();

$user->readOne();

if ($user->login != null) {
    $user_arr = array(
        "id" =>  $user->id,
        "login" => $user->login,
        "description" => $user->description,
        "created" => $user->created,
        "modified" => $user->modified,
        "deleted" => $user->deleted
    );

    http_response_code(200);

    echo json_encode($user_arr);
} else {
    http_response_code(404);

    echo json_encode(array("message" => "Такого пользователя нет"));
}
