CREATE DATABASE IF NOT EXISTS trabalho_terc_bimest
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE atividade_bimestre;

CREATE TABLE IF NOT EXISTS objetos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  objeto VARCHAR(100) NOT NULL,
  tipo VARCHAR(150) NOT NULL,
  levantavel BOOLEAN NOT NULL DEFAULT 1
);

INSERT INTO objetos (objeto, tipo, levantavel) VALUES
('Espada', 'Arma', 1),
('Montanha', 'Formação Natural', 0),
('Telescópio Hubble', 'Satelite Artificial', 0);
