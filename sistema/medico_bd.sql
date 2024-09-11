-- Criar o banco de dados
CREATE DATABASE saep_bd;

-- Usar o banco de dados criado
USE saep_bd;

-- Criar a tabela de Médicos
CREATE TABLE Medicos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

-- Criar a tabela de Pacientes
CREATE TABLE Pacientes (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    medico_codigo INT,
    FOREIGN KEY (medico_codigo) REFERENCES Medicos(codigo)
);

-- Criar a tabela de Prescrições
CREATE TABLE Prescricoes (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    prescricao TEXT NOT NULL,
    paciente_codigo INT,
    FOREIGN KEY (paciente_codigo) REFERENCES Pacientes(codigo)
);

-- Inserir dados na tabela de Médicos
INSERT INTO Medicos (nome, email, senha) VALUES
('Dr. João Silva', 'joao.silva@hospital.com', 'senha123'),
('Dra. Maria Oliveira', 'maria.oliveira@hospital.com', 'senha456'),
('Dr. Pedro Santos', 'pedro.santos@hospital.com', 'senha789');

-- Inserir dados na tabela de Pacientes
INSERT INTO Pacientes (nome, medico_codigo) VALUES
('Ana Paula', 1),
('Carlos Souza', 2),
('Juliana Ferreira', 3);

-- Inserir dados na tabela de Prescrições
INSERT INTO Prescricoes (prescricao, paciente_codigo) VALUES
('Tomar 1 comprimido de Paracetamol a cada 8 horas', 1),
('Aplicar pomada 2 vezes ao dia', 2),
('Ingerir 10 ml de xarope antes de dormir', 3);

-- Adicionar mais registros para garantir funcionamento adequado

INSERT INTO Pacientes (nome, medico_codigo) VALUES
('Luiz Carlos', 1),
('Patricia Lima', 2),
('Fernando Almeida', 3);

INSERT INTO Prescricoes (prescricao, paciente_codigo) VALUES
('Tomar 1 comprimido de Ibuprofeno a cada 12 horas', 1),
('Aplicar colírio 3 vezes ao dia', 2),
('Ingerir 5 ml de antialérgico a cada 6 horas', 3),
('Fazer repouso e hidratação', 4),
('Tomar 1 comprimido de antibiótico a cada 8 horas', 5),
('Aplicar gelo no local da dor', 6);