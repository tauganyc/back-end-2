<?php

require_once __DIR__.'/../services/UserService.php';

class UserController {
    private $service;

    public function __construct() {
        $this->service = new UserService();
    }

    public function handleRequest($method, $id = null) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    echo json_encode($this->service->getUserById($id));
                } else {
                    echo json_encode($this->service->getAllUsers());
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($this->service->createUser($data));
                break;
            case 'PUT':
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($this->service->updateUser($id, $data));
                break;
            case 'DELETE':
                echo json_encode($this->service->deleteUser($id));
                break;
            default:
                http_response_code(405);
                echo json_encode(["message" => "Método não implementado"]);
        }
    }
}

