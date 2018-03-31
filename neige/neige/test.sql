drop database if exists neige;
create database neige;
  use neige;

CREATE TABLE user(
        id         int (11) Auto_increment  NOT NULL ,
        nom        Text ,
        prenom     Text ,
        email      Varchar (25) ,
        password   Text ,
        adresse    Text ,
        ville      Text ,
        cp         Int ,
        tel        Varchar (12) ,
        datebirth  Date ,
        status     Int ,
        createdate Date ,
        civilite enum('Mr','Mme'),
        PRIMARY KEY (id ) ,
        UNIQUE (email )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reservation
#------------------------------------------------------------

CREATE TABLE reservation(
        idreservation int (11) Auto_increment  NOT NULL ,
        id            Int ,
        name          Text ,
        idlogement    Int ,
        item          Text ,
        start_day     Int ,
        start_time    Int ,
        end_day       Int ,
        end_time      Int ,
        canceled      Int ,
        idcontratloc  Int ,
        PRIMARY KEY (idreservation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: logement
#------------------------------------------------------------

CREATE TABLE logement(
        idlogement      int (11) Auto_increment  NOT NULL ,
        titre           Text ,
        emplacement     Text ,
        etage           Int ,
        prix            Float ,
        taille          Text ,
        idtype          Int ,
        caracteristique Text ,
        id              Int ,
        photo           Text ,
        createdate      Date ,
        idreservation   Int ,
        idcontratlog    Int ,
        status enum("valide","invalide","en attente") DEFAULT 'en attente',
        PRIMARY KEY (idlogement )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type
#------------------------------------------------------------

CREATE TABLE type(
        idtype Int NOT NULL ,
        nom    Varchar (25) ,
        PRIMARY KEY (idtype )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: requestuser
#------------------------------------------------------------

CREATE TABLE requestuser(
        idrequ int (11) Auto_increment  NOT NULL ,
        idreq  Int NOT NULL ,
        PRIMARY KEY (idrequ ,idreq )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: requestlogement
#------------------------------------------------------------

CREATE TABLE requestlogement(
        idreql int (11) Auto_increment  NOT NULL ,
        idreq  Int NOT NULL ,
        PRIMARY KEY (idreql ,idreq )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: request
#------------------------------------------------------------

CREATE TABLE request(
        idreq      int (11) Auto_increment  NOT NULL ,
        createdate Date ,
        id         Int ,
        email      Varchar (25) ,
        idlogement Int ,
        status enum('En attente','Valide','Invalide') DEFAULT 'En attente',
        PRIMARY KEY (idreq )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: admin
#------------------------------------------------------------

CREATE TABLE admin(
        id Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: client
#------------------------------------------------------------

CREATE TABLE client(
        id Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: proprietaire
#------------------------------------------------------------

CREATE TABLE proprietaire(
        id Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contratlocation
#------------------------------------------------------------

CREATE TABLE contratlocation(
        idcontratloc    int (11) Auto_increment  NOT NULL ,
        idreservation   Int ,
        idlogement      Int ,
        createdate      Date ,
        PRIMARY KEY (idcontratloc )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contratlogement
#------------------------------------------------------------

CREATE TABLE contratlogement(
        idcontratlog int (11) Auto_increment  NOT NULL ,
        id           Int ,
        idlogement   Int ,
        createdate   Date ,
        PRIMARY KEY (idcontratlog )
)ENGINE=InnoDB;

ALTER TABLE reservation ADD CONSTRAINT FK_reservation_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE reservation ADD CONSTRAINT FK_reservation_idcontratloc FOREIGN KEY (idcontratloc) REFERENCES contratlocation(idcontratloc);
ALTER TABLE logement ADD CONSTRAINT FK_logement_idtype FOREIGN KEY (idtype) REFERENCES type(idtype);
ALTER TABLE logement ADD CONSTRAINT FK_logement_idcontratlog FOREIGN KEY (idcontratlog) REFERENCES contratlogement(idcontratlog);
ALTER TABLE requestuser ADD CONSTRAINT FK_requestuser_idreq FOREIGN KEY (idreq) REFERENCES request(idreq);
ALTER TABLE requestlogement ADD CONSTRAINT FK_requestlogement_idreq FOREIGN KEY (idreq) REFERENCES request(idreq);
ALTER TABLE request ADD CONSTRAINT FK_request_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE admin ADD CONSTRAINT FK_admin_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE client ADD CONSTRAINT FK_client_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE proprietaire ADD CONSTRAINT FK_proprietaire_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE contratlocation ADD CONSTRAINT FK_contratlocation_idlogement FOREIGN KEY (idlogement) REFERENCES logement(idlogement);
ALTER TABLE contratlocation ADD CONSTRAINT FK_contratlocation_idreservation FOREIGN KEY (idreservation) REFERENCES reservation(idreservation);
ALTER TABLE contratlogement ADD CONSTRAINT FK_contratlogement_id FOREIGN KEY (id) REFERENCES user(id);


INSERT INTO type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `civilite`, `adresse`, `ville`, `cp`, `tel`, `datebirth`, `status`, `createdate`) VALUES
  (1, 'DETEST', 'Joe', 'joe@test.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '27 rue Hector Bleu', 'PARIS', 95300, '0745676858', '2018-03-06', 9, '2018-03-04'),
  (2, 'BADI', 'Bado', 'bado@mail.test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '24 rue bien', 'PARIS', 95300, '0745676858', '2018-03-06', 0, '2018-03-04');

INSERT INTO `logement` (`idlogement`, `titre`, `emplacement`, `etage`, `prix`, `taille`, `idtype`, `caracteristique`, `id`, `photo`, `createdate`, `status`, `idreservation`) VALUES
  (1, 'Chalet Ancien Rustique', 'Alpes', '1 etage', '12EUR', '100', 2, 'Beau', 2, './photos/0364393c078aa2bed12e82f7c3fc9efc', '2018-03-04', 'en attente', NULL),
  (2, 'Chalet Ancien Rustique', 'Alpes', '1er', '12EUR', '100', 2, 'beau', 2, './photos/71ce3ce7b8df56795f26005b53bea16c', '2018-03-04', 'en attente', NULL),
  (3, 'Chalet Ancien Rustique', 'Alpes', '1er', '12EUR', '100', 2, 'beau', 2, './photos/455e981c88f0e5db165c03f7fa55eaa1', '2018-03-04', 'invalide', NULL),
  (4, 'Appartement Spacieux', 'Alpes', '1er', '11EUR', '100', 1, 'Beau', 1, './photos/c8eb3be435008b7d22e4225287de602c', '2018-03-04', 'valide', NULL);
