DELETE FROM medecin;
DELETE FROM patient;
DELETE FROM rdv;

INSERT INTO patient (email, nom, prenom, mdp, telephone) VALUES
('alexandre.auguste@isen-ouest.yncrea.fr', 'Auguste', 'Alexandre','php','0767424852'),
('alexandre.auguste44@gmail.com', 'Roquelle','Maxime','golem', '0767424853');

INSERT INTO medecin (email, nom, prenom, mdp, telephone, codepostal, specialite) VALUES
('ziox.fake@gmail.com', 'Joestar', 'Joseph', 'jojo','0767424852', '44980', 'onde'),
('alexandre.auguste44@gmail.com', 'Zeppli', 'Ceasar', 'savon', '0782083299', '44700', 'mort');

INSERT INTO rdv (debut, fin, libre, medecinemail, patientemail, informations) VALUES
('2016-06-22 19:10:25-07', '2016-06-22 20:10:25-07', TRUE,'ziox.fake@gmail.com','alexandre.auguste@isen-ouest.yncrea.fr', 'Je suis un medecin'),
('2016-06-22 12:10:25-07','2016-06-22 13:10:25-07',TRUE, 'alexandre.auguste44@gmail.com','alexandre.auguste44@gmail.com', 'Je suis un bon medecin');




