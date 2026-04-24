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
    Durata INT NOT NULL,
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
    IdUtente INT NOT NULL,
    PRIMARY KEY(IdAlert),
    FOREIGN KEY(IdUtente) REFERENCES Utenti(IdUtente)
);

INSERT INTO Utenti (Nome, Cognome, Email, Pword, Ruolo) VALUES
('Mario', 'Rossi', 'mario@email.it', 'pass123', 'Admin'), -- pass123

('Luca', 'Bianchi', 'luca@email.it', 'pass456', 'Utente'),
('Giulia', 'Verdi', 'giulia@email.it', 'pass789', 'Utente'),
('Anna', 'Neri', 'anna@email.it', 'pass321', 'Utente'),
('Paolo', 'Gialli', 'paolo@email.it', 'pass654', 'Admin');

INSERT INTO Orti (Nome, PosizioneGPS, Tipo, IdUtente) VALUES
('Orto Nord', '43.4631, 11.8796', 'Orto', 1),
('Serra Sud', '43.4620, 11.8805', 'Serra', 2),
('Orto Est', '43.4640, 11.8810', 'Orto', 3),
('Serra Ovest', '43.4650, 11.8820', 'Serra', 4),
('Orto Centrale', '43.4635, 11.8800', 'Orto', 5);

INSERT INTO Sensori (TipoSensore, PosizioneGPS, IdOrto) VALUES
('Temperatura', '43.4632, 11.8797', 1),
('Umidita', '43.4621, 11.8806', 2),
('PH', '43.4641, 11.8811', 3),
('Luce', '43.4651, 11.8821', 4),
('Umidita', '43.4636, 11.8801', 5);

INSERT INTO Misurazioni (Valore, IdSensore) VALUES
(25, 1),
(60, 2),
(6.5, 3),
(800, 4),
(45, 5);

INSERT INTO Irrigazioni (Durata, LitriAcquaConsumata, IdOrto) VALUES
('0h 30\' 00\'\'', '50L', 1),
('0h 45\' 00\'\'', '70L', 2),
('0h 20\' 00\'\'', '30L', 3),
('1h 10\' 30\'\'', '90L', 4),
('0h 55\' 40\'\'', '65L', 5);

INSERT INTO Alert (Tipo, Descrizione, IdUtente) VALUES
('Temperatura Alta', 'Temperatura oltre soglia nell\'orto', 1),
('Umidità Bassa', 'Livello umidità troppo basso', 2),
('Irrigazione Necessaria', 'Il terreno è troppo secco', 3),
('Sensore Offline', 'Il sensore non risponde', 4),
('Acqua Insufficiente', 'Serbatoio quasi vuoto', 5);