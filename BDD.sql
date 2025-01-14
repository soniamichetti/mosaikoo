create database bdmosaique;

use bdmosaique;

CREATE TABLE ADMIN (
    ID_ADMIN INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LOGIN CHAR(32) DEFAULT NULL,
    MDP CHAR(32) DEFAULT NULL
);

INSERT INTO `admin` (`ID_ADMIN`, `LOGIN`, `MDP`) VALUES
(2, 'admin1', '0192023a7bbd73250516f069df18b500'),
(3, 'Admin2', '60809c983da6d6e1198c78f23f7986cd'),
(4, 'cj', 'f71dbe52628a3f83a77ab494817525c6'),
(5, 'mosaic', '6d788fcb39cecfd54da7b065a8b75d1a');

CREATE TABLE ETAT_PROSPECT (
    id_etat INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LIBELLE CHAR(32) DEFAULT NULL
);

CREATE TABLE PROSPECT (
    ID_ETAT INT NOT NULL,
    id_prospect INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
    NOM CHAR(32) DEFAULT NULL,
    EMAIL CHAR(32) NOT NULL,
    PRENOM CHAR(32) DEFAULT NULL,
    VILLE CHAR(32) DEFAULT NULL,
    WEB_MOBILE CHAR(32) DEFAULT NULL,
    SYSTEME_EXPLOITATION CHAR(32) DEFAULT NULL,
    ADRESSE_IP CHAR(32) DEFAULT NULL,
    MAPS CHAR(32) DEFAULT NULL,
    IMAGE_ENTREE CHAR(32) DEFAULT NULL,
    numero_telephone VARCHAR(15) DEFAULT NULL,
    Navigateur VARCHAR(32) DEFAULT NULL,
    Date_prospect DATE DEFAULT NULL,
    STYLEMOSAIQUE VARCHAR(255) DEFAULT NULL,
    Projet VARCHAR(255) DEFAULT NULL,
    date_creation DATE DEFAULT NULL,
    FOREIGN KEY (ID_ETAT) REFERENCES etat_prospect(ID_ETAT) ON DELETE CASCADE
);

CREATE TABLE APPEL (
    id_appel INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NUMERO_DE_TELEPHONE CHAR(32) DEFAULT NULL,
    CONTENU_D_APPEL TEXT DEFAULT NULL,
    id_prospect INT DEFAULT NULL,
    Date DATE DEFAULT NULL,
    FOREIGN KEY (id_prospect) REFERENCES PROSPECT(id_prospect) ON DELETE SET NULL
);


CREATE TABLE ESSAI (
    ID_ESSAIE INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    EMAIL CHAR(32) NOT NULL,
    IMAGE_D_ENTREE CHAR(128) DEFAULT NULL,
    IMAGE_MOSAIQUE CHAR(128) DEFAULT NULL,
    STYLEMOSAIQUE CHAR(32) DEFAULT NULL,
    TYPEPROJET CHAR(32) DEFAULT NULL,
    id_prospect INT DEFAULT NULL,
    FOREIGN KEY (id_prospect) REFERENCES PROSPECT(id_prospect) ON DELETE SET NULL
);



CREATE TABLE LOCALISATION (
    ID_LOCALISATION INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LIBELLE CHAR(32) DEFAULT NULL,
    COORDONNEES_GEOGRAPHIQUE CHAR(32) DEFAULT NULL,
    lat DOUBLE DEFAULT NULL,
    lng DOUBLE DEFAULT NULL
);


CREATE TABLE PROJET (
    id_projet INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_LOCALISATION INT DEFAULT NULL,
    ADRESSE CHAR(32) DEFAULT NULL,
    Hauteur DOUBLE(5,2) DEFAULT NULL,
    DESCRIPTION_DU_PROJET TEXT DEFAULT NULL,
    largeur DOUBLE NOT NULL,
    VILLE VARCHAR(255) NOT NULL,
    CodeP VARCHAR(255) NOT NULL,
    Delai_Projet DATE DEFAULT NULL,
    STYLEMOSAIQUE VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (ID_LOCALISATION) REFERENCES localisation(ID_LOCALISATION) ON DELETE SET NULL
);



CREATE TABLE PROSPECT_APPEL (
    EMAIL CHAR(32) NOT NULL,
    ID_APPEL CHAR(32) NOT NULL,
    PRIMARY KEY (EMAIL, ID_APPEL)
);


INSERT INTO etat_prospect (id_etat, libelle) VALUES (1, 'Client');
INSERT INTO etat_prospect (id_etat, libelle) VALUES (2, 'En cours');
INSERT INTO etat_prospect (id_etat, libelle) VALUES (3, 'Terminé');
