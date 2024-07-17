USE bibliotheque;
CREATE TABLE Utilisateur (
    Code_Membre INT AUTO_INCREMENT PRIMARY KEY,
    Prenom VARCHAR(50),
    Nom VARCHAR(50),
    Adresse VARCHAR(100),
    Telephone VARCHAR(100),
    Courriel VARCHAR(100),
    Mot_De_Passe VARCHAR(225),
    Role ENUM("employe", "admin", "membre")
);

CREATE TABLE Document (
    Code_Document INT AUTO_INCREMENT PRIMARY KEY,
    Titre VARCHAR(100),
    Auteur VARCHAR(100),
    AnneeProduction YEAR,
    Categorie ENUM('roman', 'bande_dessinee', 'jeux_video', 'DVD', 'Blu_ray', 'CD'),
    Type ENUM('enfant', 'ado', 'adulte'),
    Genre ENUM('comedie', 'drame', 'horreur', 'sci_fi', 'documentaire'),
    Description TEXT,
    ISBN VARCHAR(13)
);

CREATE TABLE Reservation (
    Reservation_ID INT AUTO_INCREMENT PRIMARY KEY,
    Code_Membre INT,
    Code_Document INT,
    Status ENUM('prete', 'annule', 'termine', 'reserve'),
    Date_Reservation_Debut DATE,
    Date_Reservation_Retour DATE,
    FOREIGN KEY (Code_Membre) REFERENCES Utilisateur(Code_Membre),
    FOREIGN KEY (Code_Document) REFERENCES Document(Code_Document)
);

