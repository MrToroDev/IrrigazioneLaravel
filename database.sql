DROP DATABASE IF EXISTS 5cia_Irrigazione;
CREATE DATABASE 5cia_Irrigazione;

USE 5cia_Irrigazione;

DROP TABLE IF EXISTS Utenti;
CREATE TABLE Utenti(
    IdUtente INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(40) NOT NULL,
    Cognome VARCHAR(40) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Pword VARCHAR(255) NOT NULL,
    Ruolo ENUM('Admin', 'User') NOT NULL,

    `enabled` BIT DEFAULT 1,

    updated_at DATETIME,
    created_at DATETIME,

    PRIMARY KEY(IdUtente)
);

DROP TABLE IF EXISTS Orti;
CREATE TABLE IF NOT EXISTS Orti(
    IdOrto INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(500) NOT NULL,
    Latitudine FLOAT NOT NULL,
    Longitudine FLOAT NOT NULL,
    Tipo ENUM('Garden', 'Greenhouse') NOT NULL,

    updated_at DATETIME,
    created_at DATETIME,
    `deleted` BIT DEFAULT 0,

    IdUtente INT NOT NULL,
    PRIMARY KEY(IdOrto),
    FOREIGN KEY(IdUtente) REFERENCES Utenti(IdUtente)
);

DROP TABLE IF EXISTS Sensori;
CREATE TABLE IF NOT EXISTS Sensori(
    IdSensore INT NOT NULL AUTO_INCREMENT,
    TipoSensore ENUM('Temperature', 'Umitidy', 'UV', 'PH', 'Lux') NOT NULL,
    Latitudine FLOAT NOT NULL,
    Longitudine FLOAT NOT NULL,
    Nome VARCHAR(200) NOT NULL,

    updated_at DATETIME,
    created_at DATETIME,
    `deleted` BIT DEFAULT 0,

    IdOrto INT NOT NULL,
    PRIMARY KEY(IdSensore),
    FOREIGN KEY(IdOrto) REFERENCES Orti(IdOrto)
);

DROP TABLE IF EXISTS Misurazioni;
CREATE TABLE IF NOT EXISTS Misurazioni(
    IdMisurazione INT NOT NULL AUTO_INCREMENT,
    Valore FLOAT NOT NULL,
    DataOraMisurazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,

    IdSensore INT NOT NULL,
    PRIMARY KEY(IdMisurazione),
    FOREIGN KEY(IdSensore) REFERENCES Sensori(IdSensore)
);

DROP TABLE IF EXISTS Irrigazioni;
CREATE TABLE IF NOT EXISTS Irrigazioni(
    IdIrrigazione INT NOT NULL AUTO_INCREMENT,
    LitriAcquaConsumata INT NOT NULL,
    DataOraIrrigazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,

    IdOrto INT NOT NULL,
    PRIMARY KEY(IdIrrigazione),
    FOREIGN KEY(IdOrto) REFERENCES Orti(IdOrto)
);

DROP TABLE IF EXISTS Alert;
CREATE TABLE IF NOT EXISTS Alert(
    IdAlert INT NOT NULL AUTO_INCREMENT,
    Tipo ENUM('INFO', 'WARNING', 'DANGER') NOT NULL,
    Descrizione VARCHAR(500) NOT NULL,
    DataOraAlert TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    Visualizzato DATETIME,
    Deleted BIT DEFAULT 0,

    IdUtente INT NOT NULL,
    PRIMARY KEY(IdAlert),
    FOREIGN KEY(IdUtente) REFERENCES Utenti(IdUtente)
);

INSERT INTO Utenti (Nome, Cognome, Email, Pword, Ruolo) VALUES
('Mario', 'Rossi', 'mario@email.it', '$2y$12$r/Dq2H/k3exYzODQw3LXAOQpit4JxW/nBr67rbKXu4GiCZd9qjSqe', 'Admin'), -- pass123
('Luca', 'Bianchi', 'luca@email.it', '$2a$12$cx4suO65y4YYnmd5.Qe3A.AJz2fed2lqIcVRLhL3484Y1aswJa1G.', 'User'); -- pass456

INSERT INTO Orti (Nome, Latitudine, Longitudine, Tipo, IdUtente) VALUES
('Orto Nord', 43.4631, 11.8796, 'Garden', 1),
('Serra Sud', 43.4620, 11.8805, 'Greenhouse', 2);

INSERT INTO Sensori (Nome, TipoSensore, Latitudine, Longitudine, IdOrto) VALUES
('Temp1', 'Temperature', 43.4632, 11.8797, 1),
('Umid1', 'Umidity', 43.4621, 11.8806, 2);

INSERT INTO Misurazioni (Valore, IdSensore) VALUES
(25, 1),
(60, 2);

INSERT INTO Irrigazioni (LitriAcquaConsumata, IdOrto) VALUES
('50L', 1),
('70L', 2);

INSERT INTO Alert (Tipo, Descrizione, IdUtente) VALUES
('WARNING', "Temperatura oltre soglia nell'orto 1", 1),
('WARNING', "Livello umidità troppo basso", 2),
('DANGER', "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 1);