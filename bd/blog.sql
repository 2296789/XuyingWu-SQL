CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));

INSERT INTO utilisateur(nom, email) VALUES
('AAA', 'a@a.a'),
('BBB', 'b@b.b'),
('CCC', 'c@c.c'),
('DDD', 'd@d.d'),
('EEE', 'e@e.e');

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categorie` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));

INSERT INTO categorie (categorie) VALUES
('Art'), 
('Culture'), 
('Science'), 
('Histoire'), 
('Loisirs');

CREATE TABLE IF NOT EXISTS `article` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NOT NULL,
  `text` TEXT(1000) NOT NULL,
  `auteur_id` INT NOT NULL,
  `categorie_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_article_auteur_idx` (`auteur_id` ASC) ,
  INDEX `fk_article_categorie_idx` (`categorie_id` ASC) ,
  CONSTRAINT `fk_article_auteur`
    FOREIGN KEY (`auteur_id`)
    REFERENCES `utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_categorie`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `categorie` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO article (titre, text, auteur_id, categorie_id) VALUES
("Léonard de Vinci", "Léonard de Vinci né le 14 avril 1452 du calendrier actuel à Vinci et mort le 2 mai 1519 à Amboise, est un peintre polymathe, simultanément artiste, organisateur de spectacles et de fêtes, scientifique, ingénieur, inventeur, anatomiste, sculpteur, peintre, architecte, urbaniste, botaniste, musicien, philosophe et écrivain. Enfant naturel d'une paysanne, Caterina di Meo Lippi, et d'un notaire, Pierre de Vinci, il est élevé auprès de ses grands-parents paternels dans la maison familiale de Vinci jusqu’à l’âge de dix ans. À Florence, son père l'inscrit pour deux ans d’apprentissage dans une scuola d’abaco et ensuite à l'atelier d'Andrea del Verrocchio où il côtoie Botticelli, Le Pérugin et Domenico Ghirlandaio.",'1','1'),
("Les Mille et Une Nuits", "Les Mille et Une Nuits est un recueil anonyme de contes populaires d'origine persane, indienne et arabe. Il est constitué de nombreux contes enchâssés et de personnages mis en miroir les uns par rapport aux autres.", '2', '2'),
("Diamant synthétique", "Un diamant synthétique est produit en utilisant différentes techniques physiques et chimiques, visant à reproduire la structure des diamants naturels. Ces diamants de synthèse sont utilisés dans l'industrie et peuvent être de qualité variable. Selon plusieurs sources, le marché des diamants synthétiques est en expansion notamment dans les domaines de la joaillerie, de l'électronique et des hautes technologies, qui exigent une qualité et une pureté élevées. Le marché des diamants de laboratoire est passé de 1 % du marché des diamants bruts de 14 milliards de dollars en 2016 à environ 2 à 3 % en 2019.",'3','3'),
("Conflit israélo-palestinien", "Le conflit israélo-palestinien désigne le conflit qui oppose Palestiniens et Israéliens au Proche-Orient. Il oppose deux mouvements nationaux. Le conflit inclut une forte dimension religieuse, en raison de l'importance des territoires disputés, notamment Jérusalem, pour les trois religions monothéistes, et du fait de la caractérisation d'Israël comme État juif, à majorité juive et face à des Palestiniens majoritairement musulmans.", '4', '4'),
("Yoga","Le yoga est l'une des six écoles orthodoxes de la philosophie indienne āstika dont le but est la libération. C'est une discipline ou pratique commune à plusieurs époques et courants, visant, par la méditation, l'ascèse et les exercices corporels, à réaliser l'unification de l'être humain dans ses aspects physique, psychique et spirituel.",'5','5');

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `contenu` TEXT(500) NULL,
  `article_id` INT NOT NULL,
  `utilisateur_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_commentaire_article_idx` (`article_id` ASC) ,
  INDEX `fk_commentaire_utilisateur_idx` (`utilisateur_id` ASC) ,
  CONSTRAINT `fk_commentaire_article`
    FOREIGN KEY (`article_id`)
    REFERENCES `article` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentaire_utilisateur`
    FOREIGN KEY (`utilisateur_id`)
    REFERENCES `utilisateur` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO commentaire (contenu, article_id, utilisateur_id) VALUES 
("très bon !", 1, 1),
("Très intéressant.", 2, 2),
("C'est bon à savoir.", 3, 3),
("C'est un peu difficile à comprendre.", 4, 4),
("Je l'aime bien.", 5, 5);