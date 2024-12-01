<?php

require_once __DIR__.'/../repositories/UserRepository.php';

class UserService {
    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function getAllUsers() {
        return $this->repository->getAll();
    }

    public function getUserById($id) {
        return $this->repository->getById($id);
    }

    public function createUser($data) {
        if (empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            return ["message" => "Invalid input"];
        }
        return $this->repository->create($data);
    }

    public function updateUser($id, $data) {
        return $this->repository->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->repository->delete($id);
    }
}

