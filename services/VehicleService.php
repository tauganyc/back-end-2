<?php

require_once __DIR__.'/../repositories/VehicleRepository.php';

class VehicleService {
    private $repository;

    public function __construct() {
        $this->repository = new VehicleRepository();
    }

    public function getAllVehicles($filters = []) {
        return $this->repository->getAll($filters);
    }

    public function getVehicleById($id) {
        return $this->repository->getById($id);
    }

    public function createVehicle($data) {
        if (empty($data['marca']) || empty($data['modelo']) || empty($data['ano']) || empty($data['preco'])) {
            http_response_code(400);
            return ["message" => "Invalid input"];
        }
        return $this->repository->create($data);
    }

    public function updateVehicle($id, $data) {
        return $this->repository->update($id, $data);
    }

    public function deleteVehicle($id) {
        return $this->repository->delete($id);
    }
}

