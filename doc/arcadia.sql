--
--
-- Structure de la table animal
--
CREATE TABLE animal (
    id int NOT NULL AUTO_INCREMENT,
    breed_id int DEFAULT NULL,
    habitat_id int DEFAULT NULL,
    name varchar(64) NOT NULL,
    health varchar(128) DEFAULT NULL,
    description longtext,
    slug varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY IDX_6AAB231FA8B4A30F (breed_id),
    KEY IDX_6AAB231FAFFE2D26 (habitat_id)
);

--
-- Structure de la table breed
--
CREATE TABLE breed (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    detail longtext,
    slug varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

--
-- Structure de la table comment
--
CREATE TABLE comment (
    id int NOT NULL AUTO_INCREMENT,
    pseudo varchar(64) NOT NULL,
    comment_text longtext NOT NULL,
    is_visible tinyint(1) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

--
-- Structure de la table eating
--
CREATE TABLE eating (
    id int NOT NULL AUTO_INCREMENT,
    food_id int DEFAULT NULL,
    feeding varchar(255) NOT NULL,
    quantity int DEFAULT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY IDX_C65A1401BA8E87C4 (food_id)
);

--
-- Structure de la table food
--
CREATE TABLE food (
    id int NOT NULL AUTO_INCREMENT,
    animal_id int DEFAULT NULL,
    time time DEFAULT NULL,
    updated_at datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int DEFAULT NULL,
    slug varchar(255) NOT NULL,
    PRIMARY KEY (id),
    KEY `IDX_D43829F78E962C16` (animal_id),
    KEY `IDX_D43829F7A76ED395` (user_id)
);

--
-- Structure de la table habitat
--
CREATE TABLE habitat (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(64) NOT NULL,
    description longtext,
    comment_habitat longtext,
    slug varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

--
-- Structure de la table image
--
CREATE TABLE image (
    id int NOT NULL AUTO_INCREMENT,
    animal_id int DEFAULT NULL,
    habitat_id int DEFAULT NULL,
    title varchar(255) NOT NULL,
    name varchar(255) DEFAULT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY IDX_C53D045F8E962C16 (animal_id),
    KEY IDX_C53D045FAFFE2D26 (habitat_id)
);

--
-- Structure de la table report
--
CREATE TABLE report (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    animal_id int NOT NULL,
    date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    detail longtext NOT NULL,
    suggest longtext,
    PRIMARY KEY (id),
    KEY IDX_C42F7784A76ED395 (user_id),
    KEY IDX_C42F77848E962C16 (animal_id)
);

--
-- Structure de la table service
--
CREATE TABLE service (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    description longtext,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    slug varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

--
-- Structure de la table suggest_feeding
--
CREATE TABLE suggest_feeding (
    id int NOT NULL AUTO_INCREMENT,
    animal_id int DEFAULT NULL,
    user_id int DEFAULT NULL,
    feeding varchar(255) DEFAULT NULL,
    quantity int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY IDX_A6A77DEB8E962C16 (animal_id),
    KEY IDX_A6A77DEBA76ED395 (user_id)
);

--
-- Structure de la table user
--
CREATE TABLE user (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(180) NOT NULL,
    roles json NOT NULL,
    password varchar(255) NOT NULL,
    firstname varchar(64) NOT NULL,
    lastname varchar(64) NOT NULL,
    is_verified tinyint(1) NOT NULL,
    reset_token varchar(100) DEFAULT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY UNIQ_IDENTIFIER_EMAIL (email)
);

--
-- Contraintes pour la table animal
--
ALTER TABLE animal
    ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id),
    ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id);
--
-- Contraintes pour la table eating
--
ALTER TABLE eating
    ADD CONSTRAINT FK_C65A1401BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id);

--
-- Contraintes pour la table food
--
ALTER TABLE food
    ADD CONSTRAINT FK_D43829F78E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id),
    ADD CONSTRAINT FK_D43829F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);

--
-- Contraintes pour la table image
--
ALTER TABLE image
    ADD CONSTRAINT FK_C53D045F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id),
    ADD CONSTRAINT FK_C53D045FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (id);

--
-- Contraintes pour la table report
--
ALTER TABLE report
    ADD CONSTRAINT FK_C42F77848E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id),
    ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);

--
-- Contraintes pour la table suggest_feeding
--
ALTER TABLE suggest_feeding
    ADD CONSTRAINT FK_A6A77DEB8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id),
    ADD CONSTRAINT FK_A6A77DEBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id);