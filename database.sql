CREATE DATABASE farmacia;
USE farmacia;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao VARCHAR(255)
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    receita CHAR(200),
    descricao BLOB(500) NOT NULL,
    categoria_id INT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
);

INSERT INTO categorias (nome, descricao) VALUES
    ('Analgésicos', 'Medicamentos para alívio de dor'),
    ('Antibióticos', 'Medicamentos para combate a infecções bacterianas'),
    ('Vitaminas', 'Suplementos vitamínicos'),
    ('Higiene', 'Produtos de higiene pessoal'),
    ('Cuidados pessoais', 'Produtos de cuidado e bem-estar');

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
