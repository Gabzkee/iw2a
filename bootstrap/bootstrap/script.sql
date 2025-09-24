CREATE DATABASE trabalho;
USE trabalho;
CREATE TABLE objetos (
    id_item INT PRIMARY KEY AUTO_INCREMENT,
    nome_item varchar(50),
    codigo_item varchar(07),
    peso varchar(70),
    levantavel boolean,
)