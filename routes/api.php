<?php

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/VehicleController.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

if (isset($uri[0]) && $uri[0] === 'api') {
    if (isset($uri[1])) {
        switch ($uri[1]) {
            case 'usuarios':
                $controller = new UserController();
                if (isset($uri[2])) {
                    $controller->handleRequest($method, $uri[2]);
                } else {
                    $controller->handleRequest($method);
                }
                break;

            case 'veiculos':
                $controller = new VehicleController();
                if (isset($uri[3])) {
                    $controller->handleRequest($method, $uri[2]);
                } else {
                    $controller->handleRequest($method);
                }
                break;

            case 'db':
                require_once __DIR__ . '/../db/DatabaseInitializer.php';
                $initializer = new DatabaseInitializer();
                echo json_encode($initializer->initialize());
                break;

            default:
                http_response_code(404);
                echo json_encode(["message" => "Rota não encontrada"]);
                break;
        }
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada"]);
    }
} else {
    if ($_SERVER['REQUEST_URI'] === '/') {
        echo json_encode([
            "rotas" => [
                ["metodo" => "GET", "caminho" => "/api/usuarios"],
                ["metodo" => "GET", "caminho" => "/api/usuarios/{id}"],
                ["metodo" => "POST", "caminho" => "/api/usuarios"],
                ["metodo" => "PUT", "caminho" => "/api/usuarios/{id}"],
                ["metodo" => "DELETE", "caminho" => "/api/usuarios/{id}"],
                ["metodo" => "GET", "caminho" => "/api/veiculos"],
                ["metodo" => "GET", "caminho" => "/api/veiculos/{id}"],
                ["metodo" => "POST", "caminho" => "/api/veiculos"],
                ["metodo" => "PUT", "caminho" => "/api/veiculos/{id}"],
                ["metodo" => "DELETE", "caminho" => "/api/veiculos/{id}"],
                ["metodo" => "GET", "caminho" => "/api/db"]
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada"]);
    }
}
