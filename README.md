Segue a versão ajustada do seu README, com melhorias na organização, correção de informações e formatação mais clara:

---

# **Marketplace de Carros Usados**

Este projeto é um **marketplace de compra e venda de carros usados**, onde usuários podem cadastrar, anunciar e visualizar veículos disponíveis no catálogo. A aplicação conta com um backend desenvolvido em PHP e um frontend simples para facilitar a navegação.

---

## **Tecnologias Utilizadas**

### **Backend**
O backend do projeto foi desenvolvido utilizando:
- **PHP 8.3 com Apache** - Linguagem principal para lógica e rotas.
- **MySQL** - Banco de dados relacional para armazenamento de dados.
- **PDO** - Interação segura com o banco de dados.
- **Composer** - Gerenciador de dependências PHP.

### **Frontend**
- **HTML e PHP** - Frontend básico para renderizar as páginas consumindo os dados da API.
- **Bootstrap (opcional)** - Para estilização e design responsivo (pode ser adicionado futuramente).

---

## **Público-Alvo**

Este marketplace é ideal para:
- Pessoas que desejam comprar ou vender carros usados de forma prática.
- Empresas e concessionárias que buscam uma plataforma para expor seus veículos.

---

## **Funcionalidades**

### **1. Cadastro e Login de Usuários**
- Usuários podem criar contas e fazer login para acessar funcionalidades exclusivas.

### **2. Anúncio de Veículos**
- Usuários autenticados podem cadastrar, editar e excluir anúncios de veículos.

### **3. Catálogo de Veículos**
- Todos os veículos cadastrados ficam disponíveis em um catálogo público, acessível mesmo sem login.
- Possibilidade de filtrar e buscar por marca, modelo, preço, entre outros.

---

## **Endpoints da API**

A API segue o padrão REST e conta com as seguintes rotas:

### **Usuários**
- **`GET /api/usuarios`**: Lista todos os usuários.
- **`GET /api/usuarios/{id}`**: Retorna um usuário específico.
- **`POST /api/usuarios`**: Cadastra um novo usuário.
- **`PUT /api/usuarios/{id}`**: Atualiza informações de um usuário.
- **`DELETE /api/usuarios/{id}`**: Exclui um usuário.

### **Veículos**
- **`GET /api/veiculos`**: Lista todos os veículos (com filtros opcionais).
- **`GET /api/veiculos/{id}`**: Retorna informações detalhadas de um veículo.
- **`POST /api/veiculos`**: Cadastra um novo veículo.
- **`PUT /api/veiculos/{id}`**: Atualiza informações de um veículo.
- **`DELETE /api/veiculos/{id}`**: Remove um veículo do catálogo.

### **Outras Rotas**
- **`GET /api/db`**: Inicializa o banco de dados com as tabelas e dados de exemplo.

---

## **Requisitos**

Para rodar o projeto, você precisará:
- **PHP 8.3 ou superior** - Compatível com PDO e extensões necessárias.
- **Composer** - Para gerenciar dependências do projeto.
- **MySQL 5.7 ou superior** - Banco de dados relacional para armazenar as informações.
- **Docker (opcional)** - Para configurar um ambiente de desenvolvimento rápido com Docker Compose.

---