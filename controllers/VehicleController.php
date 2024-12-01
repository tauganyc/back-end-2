<?php

require_once __DIR__.'/../services/VehicleService.php';

class VehicleController {
    private $service;

    public function __construct() {
        $this->service = new VehicleService();
    }

    public function handleRequest($method, $id = null) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    echo json_encode($this->service->getVehicleById($id));
                } else {
                    $filters = $_GET;
                    echo json_encode($this->service->getAllVehicles($filters));
                }
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($this->service->createVehicle($data));
                break;
            case 'PUT':
                $data = json_decode(file_get_contents("php://input"), true);
                echo json_encode($this->service->updateVehicle($id, $data));
                break;
            case 'DELETE':
                echo json_encode($this->service->deleteVehicle($id));
                break;
            default:
                http_response_code(405);
                echo json_encode(["message" => "Método não implementado"]);
        }
    }
}

