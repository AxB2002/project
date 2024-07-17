USE bibliotheque;

INSERT INTO Utilisateur (Prenom, Nom, Adresse, Telephone, Courriel, Mot_De_Passe, Role)
VALUES
('Alice', 'Dupont', '123 Rue Principale, Port-Cartier, QC', '4185550101', 'alice.dupont@example.com', 'motdepasse123', "membre"),
('Bob', 'Martin', '456 Avenue des Fleurs, Port-Cartier, QC', '4185550102', 'bob.martin@example.com', 'motdepasse456', "employe"),
('Carla', 'Leclerc', '789 Boulevard des Érables, Port-Cartier, QC', '4185550103', 'carla.leclerc@example.com', 'motdepasse789', "admin");

INSERT INTO Document (Titre, Auteur, AnneeProduction, Categorie, Type, Genre, Description, ISBN)
VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', 1943, 'roman', 'enfant', 'drame', 'Un conte philosophique qui raconte les aventures d\'un jeune prince voyageant de planète en planète.', '9782070612758'),
('Astérix le Gaulois', 'René Goscinny et Albert Uderzo', 1961, 'bande_dessinee', 'enfant', 'comedie', 'Les aventures d\'Astérix et Obélix dans leur village gaulois résistant aux Romains.', '9782012101465'),
('The Legend of Zelda: Breath of the Wild', 'Nintendo', 2017, 'jeux_video', 'ado', 'sci_fi', 'Un jeu d\'aventure où Link doit sauver le royaume d\'Hyrule.', '1234567890123'),
('Le Seigneur des Anneaux: La Communauté de l\'Anneau', 'Peter Jackson', 2001, 'DVD', 'adulte', 'sci_fi', 'Le premier film de la trilogie épique basée sur le roman de J.R.R. Tolkien.', '1234567890124'),
('Avatar', 'James Cameron', 2009, 'Blu_ray', 'adulte', 'sci_fi', 'Un film de science-fiction qui se déroule sur la planète Pandora.', '1234567890125'),
('Thriller', 'Michael Jackson', 1982, 'CD', 'adulte', 'comedie', 'L\'album le plus vendu de tous les temps, avec des chansons légendaires comme "Thriller" et "Beat It".', '1234567890126'),
('Le Journal d\'Anne Frank', 'Anne Frank', 1947, 'roman', 'ado', 'drame', 'Le témoignage poignant d\'une jeune juive cachée pendant l\'occupation allemande.', '9780553296983'),
('Harry Potter à l\'école des sorciers', 'J.K. Rowling', 1997, 'roman', 'enfant', 'fantasy', 'Le premier tome des aventures de Harry Potter, jeune sorcier découvrant le monde de la magie.', '9782070612369');

INSERT INTO Reservation (Code_Membre, Code_Document, Status, Date_Reservation_Debut, Date_Reservation_Retour) 
VALUES  
(3, 3, 'annule', '2024-06-25', '2024-06-28'), 
(1, 4, 'termine', '2024-07-01', '2024-07-05'), 
(2, 5, 'prete', '2024-07-08', '2024-07-15'), 
(3, 6, 'termine', '2024-06-20', '2024-06-25'),
(1, 1, 'prete', '2024-07-09', '2024-07-11'), -- Première réservation prêtée mais en retard
(2, 2, 'prete', '2024-07-09', '2024-07-10');  -- deuxième réservation prêtée mais en retard
(1, 2, 'reserve', '2024-07-11', '2024-07-12');  -- deuxième réservation prêtée mais en retard