
CREATE TABLE IF NOT EXISTS Utilisateur
(
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    user VARCHAR(100),
    password VARCHAR(100),
    Argent DECIMAL,
);

CREATE TABLE IF NOT EXISTS Action
(
    idAction INTEGER PRIMARY KEY AUTOINCREMENT,
    nomAction VARCHAR(100),
    valeur DECIMAL,
);

CREATE TABLE IF NOT EXISTS Action_Utilisateur
(
    idUser FOREIGN KEY REFERENCES Utilisateur(idUser),
    idAction FOREIGN KEY REFERENCES Action(idAction)
);