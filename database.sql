CREATE DATABASE farmacia;
USE farmacia;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    receita CHAR(200),
    descricao BLOB(500) NOT NULL
);

CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (usuario, senha)
VALUES (
    'admin',
    '$2y$10$T4OK19Z8cHUbXCK5xG/2w.hkz57Yz2o/z3fG4HDbTqd0acT21bl.e'
);