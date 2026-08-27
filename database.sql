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

-- Senha 'admin' -> em texto puro: 123456
-- Hash gerado com 3 camadas: md5 -> sha1 -> hash('sha256')
INSERT INTO usuarios (usuario, senha)
VALUES (
    'admin',
    '6aab13aae91e7d6fbbd038f3868d7b7879fdc639863dc3da8cdba5a4a731b200'
);
