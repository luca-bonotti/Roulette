CREATE TABLE IF NOT EXISTS Classe (
    idClasse int NOT NULL AUTO_INCREMENT,
    nomClasse varchar(30) NOT NULL,
    PRIMARY KEY (idClasse)
);
CREATE TABLE IF NOT EXISTS Eleve (
    idEleve int NOT NULL AUTO_INCREMENT,
    nomEleve varchar(30) NOT NULL,
    prenomEleve varchar(30) NOT NULL,
    pointEleve int(10) NOT NULL,
    statusEleve int(2) NOT NULL,
    idClasse int,
    PRIMARY KEY (idEleve),
    FOREIGN KEY (idClasse) REFERENCES Classe(idClasse)
);


INSERT INTO Classe (nomClasse) VALUES ('BTSSIO');
INSERT INTO Classe (nomClasse) VALUES ('BTSSIOV2');

INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('ra', 'Ato', 0, 0, 2);
INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('Billo', 'Baba', 0, 0, 2);
INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('Mus', 'Mais', 0, 0, 2);
INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('Tera', 'Ryd', 0, 0, 2);
INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('Str', 'mate', 0, 0, 2);
INSERT INTO Eleve (nomEleve, prenomEleve, pointEleve, statusEleve, idClasse) VALUES ('Al', 'Tbo', 0, 0, 2);
