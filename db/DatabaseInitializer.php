<?php

require_once __DIR__.'/../config/database.php';

class DatabaseInitializer {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function initialize() {
        try {

            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                );
            ");

            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS vehicles (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    usuario_id INT NOT NULL,
                    marca VARCHAR(50) NOT NULL,
                    modelo VARCHAR(50) NOT NULL,
                    ano INT NOT NULL,
                    preco DECIMAL(10, 2) NOT NULL,
                    descricao TEXT,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
                );
            ");

            $this->conn->exec("
                INSERT INTO users (name, email, password) VALUES
                ('John Doe', 'john.doe@example.com', '" . password_hash('password123', PASSWORD_DEFAULT) . "'),
                ('Jane Smith', 'jane.smith@example.com', '" . password_hash('mypassword', PASSWORD_DEFAULT) . "');
            ");

            $this->conn->exec("
                INSERT INTO vehicles (usuario_id, marca, modelo, ano, preco, descricao) VALUES
                (1, 'Toyota', 'Corolla', 2020, 80000.00, 'Carro em ótimo estado, pouco rodado.'),
                (2, 'Honda', 'Civic', 2019, 75000.00, 'Carro completo com ar-condicionado e bancos de couro.'),
                (1, 'Ford', 'Fiesta', 2018, 50000.00, 'Carro econômico e bem conservado.');
            ");

            return ["message" => "Banco de dados inicializado com sucesso"];
        } catch (PDOException $e) {
            http_response_code(500);
            return ["error" => "Falha ao inicializar o banco de dados: " . $e->getMessage()];
        }
    }
}

