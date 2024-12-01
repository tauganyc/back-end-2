<?php

require_once __DIR__.'/../config/database.php';

class VehicleRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($filters = []) {
        $query = "SELECT * FROM vehicles WHERE 1=1";
        if (isset($filters['marca'])) {
            $query .= " AND marca = :marca";
        }
        if (isset($filters['modelo'])) {
            $query .= " AND modelo LIKE :modelo";
        }
        $stmt = $this->conn->prepare($query);

        if (isset($filters['marca'])) {
            $stmt->bindParam(':marca', $filters['marca']);
        }
        if (isset($filters['modelo'])) {
            $stmt->bindValue(':modelo', '%' . $filters['modelo'] . '%');
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM vehicles WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO vehicles (usuario_id, marca, modelo, ano, preco, descricao) 
                  VALUES (:usuario_id, :marca, :modelo, :ano, :preco, :descricao)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $data['usuario_id']);
        $stmt->bindParam(':marca', $data['marca']);
        $stmt->bindParam(':modelo', $data['modelo']);
        $stmt->bindParam(':ano', $data['ano']);
        $stmt->bindParam(':preco', $data['preco']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->execute();
        return ["id" => $this->conn->lastInsertId()];
    }

    public function update($id, $data) {
        $query = "UPDATE vehicles SET marca = :marca, modelo = :modelo, ano = :ano, preco = :preco, descricao = :descricao 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':marca', $data['marca']);
        $stmt->bindParam(':modelo', $data['modelo']);
        $stmt->bindParam(':ano', $data['ano']);
        $stmt->bindParam(':preco', $data['preco']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->execute();
        return ["message" => "Vehicle updated"];
    }

    public function delete($id) {
        $query = "DELETE FROM vehicles WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return ["message" => "Vehicle deleted"];
    }
}

