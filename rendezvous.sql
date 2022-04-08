CREATE TABLE Patient (
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  mdp text NOT NULL,
  PRIMARY KEY(email);
);

CREATE TABLE Medecin (
  nom VARCHAR(50) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  telephone VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  mdp text NOT NULL,
  specialite VARCHAR(50)
  PRIMARY KEY(email);
 );
