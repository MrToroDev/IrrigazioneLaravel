DROP DATABASE IF EXISTS 5cia_Irrigazione;
CREATE DATABASE 5cia_Irrigazione;

USE 5cia_Irrigazione;

DROP TABLE IF EXISTS Utenti;
CREATE TABLE Utenti(
    IdUtente INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(40) NOT NULL,
    Cognome VARCHAR(40) NOT NULL,
    Email VARCHAR(20) NOT NULL,
    Pword VARCHAR(255) NOT NULL,
    Ruolo ENUM('Admin', 'Utente'),

    updated_at DATETIME,
    created_at DATETIME,

    PRIMARY KEY(IdUtente)
);

DROP TABLE IF EXISTS Orti;
CREATE TABLE IF NOT EXISTS Orti(
    IdOrto INT NOT NULL AUTO_INCREMENT,
    Nome VARCHAR(500) NOT NULL,
    PosizioneGPS VARCHAR(500) NOT NULL,
    Tipo ENUM('Orto', 'Serra'),
    IdUtente INT NOT NULL,
    PRIMARY KEY(IdOrto),
    FOREIGN KEY(IdUtente) REFERENCES Utenti(IdUtente)
);

DROP TABLE IF EXISTS Sensori;
CREATE TABLE IF NOT EXISTS Sensori(
    IdSensore INT NOT NULL AUTO_INCREMENT,
    TipoSensore ENUM('Temperatura', 'Umidita', 'UV', 'PH', 'Luce') NOT NULL,
    PosizioneGPS VARCHAR(500) NOT NULL,
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
    Tipo ENUM('INFO', 'WARNING', 'ERROR') NOT NULL,
    Descrizione VARCHAR(200) NOT NULL,
    DataOraAlert TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    Visualizzato DATETIME,
    IdUtente INT NOT NULL,
    PRIMARY KEY(IdAlert),
    FOREIGN KEY(IdUtente) REFERENCES Utenti(IdUtente)
);

INSERT INTO Utenti (Nome, Cognome, Email, Pword, Ruolo) VALUES
('Mario', 'Rossi', 'mario@email.it', '$2y$12$r/Dq2H/k3exYzODQw3LXAOQpit4JxW/nBr67rbKXu4GiCZd9qjSqe', 'Admin'), -- pass123
('Luca', 'Bianchi', 'luca@email.it', '$2a$12$cx4suO65y4YYnmd5.Qe3A.AJz2fed2lqIcVRLhL3484Y1aswJa1G.', 'Utente'); -- pass456

INSERT INTO Orti (Nome, PosizioneGPS, Tipo, IdUtente) VALUES
('Orto Nord', '43.4631, 11.8796', 'Orto', 1),
('Serra Sud', '43.4620, 11.8805', 'Serra', 2);

INSERT INTO Sensori (TipoSensore, PosizioneGPS, IdOrto) VALUES
('Temperatura', '43.4632, 11.8797', 1),
('Umidita', '43.4621, 11.8806', 2);

INSERT INTO Misurazioni (Valore, IdSensore) VALUES
(25, 1),
(60, 2);

INSERT INTO Irrigazioni (LitriAcquaConsumata, IdOrto) VALUES
('50L', 1),
('70L', 2);

INSERT INTO Alert (Tipo, Descrizione, IdUtente) VALUES
('Temperatura Alta', 'Temperatura oltre soglia nell\'orto', 1),
('Umidità Bassa', 'Livello umidità troppo basso', 2);