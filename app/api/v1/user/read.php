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

$user->read();

$stmt = $user->read()->get_result();
$num = $stmt->num_rows;

if ($num > 0) {
    $usersList = array();
    $usersList["users"] = array();

    while ($row = $stmt->fetch_assoc()) {
        extract($row);
        $user = array(
            "id" => $id,
            "login" => $login,
            "description" => $description,
            "created" => $created,
            "modified" => $modified,
            "deleted" => $deleted
        );
        array_push($usersList["users"], $user);
    }

    http_response_code(200);

    echo json_encode($usersList);
} else {
    http_response_code(404);

    echo json_encode(array("message" => "Пользователь не найден"));
}
