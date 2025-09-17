CREATE DATABASE estoque;
USE estoque;
CREATE TABLE produtos (
    id_produto INT PRIMARY KEY AUTO_INCREMENT,
    produto varchar(50),
    quantidade int (3),
    preco_unitario double(6,2),
    tipo varchar(30)
);

CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
)
INSERT INTO usuarios (nome, email, senha) VALUES
('Olavo de Carvalho', 'olavoreal@gmail.com', '$2y$10$n8Jfoildd4fjo/UNLk1DJe6Ld8hJxkgFOzL9KTaRjqUO5SmcnReWy') -- senha manjericao;

INSERT INTO produtos (produto, quantidade, preco_unitario, tipo)
('Processador Ryzen Incrivel', '15', '1500', 'processador')