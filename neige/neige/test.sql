drop database if exists neige;
create database neige;
  use neige;

create table user(
        id         int (11) auto_increment  not null ,
        civilite   enum('Mr','Mme'),
        nom        text ,
        prenom     text ,
        email      varchar (150) ,
        adresse    text ,
        ville      text ,
        cp         int ,
        tel        varchar (12) ,
        datebirth  date ,
        status     int ,
        createdate date ,
        password   text ,
        primary key (id ) ,
        unique (email )
)ENGINE=InnoDB;

create table reservation(
        idreservation int (11) auto_increment  not null ,
        id            int ,
        name          text ,
        idlogement    int ,
        item          text ,
        start_day     int ,
        start_time    int ,
        end_day       int ,
        end_time      int ,
        canceled      int default 0,
        idcontratloc  int ,
        primary key (idreservation )
)ENGINE=InnoDB;

create table logement(
        idlogement      int (11) auto_increment  not null ,
        titre           text ,
        emplacement     text ,
        etage           text ,
        prix            text ,
        taille          text ,
        idtype          int ,
        caracteristique text ,
        id              int ,
        photo           text ,
        createdate      date ,
        idcontratlog int,
        status enum("valide","invalide","en attente") DEFAULT 'en attente',
        primary key (idlogement )
)ENGINE=InnoDB;

create table type(
        idtype int not null ,
        nom    varchar (25) ,
        primary key (idtype )
)ENGINE=InnoDB;

create table request(
        idreq      int (11) auto_increment  not null ,
        createdate date ,
        id         int,
        email      text,
        idlogement int ,
        status enum('En attente','Valide logement','Invalide logement','Valide user','Invalide user') DEFAULT 'En attente',
        primary key (idreq )
)ENGINE=InnoDB;

create table contratlocation(
        idcontratloc    int (11) auto_increment  not null ,
        idreservation   int ,
        idlogement      int ,
        createdate      date ,
        primary key (idcontratloc )
)ENGINE=InnoDB;

create table contratlogement(
        idcontratlog int (11) auto_increment  not null ,
        id           int ,
        idlogement   int ,
        createdate   date ,
        primary key (idcontratlog )
)ENGINE=InnoDB;

create table contact(
        idmessage int (11) auto_increment  not null ,
        nom text,
        prenom text,
        email varchar(150),
        message text,
        createdate   date ,
        primary key (idmessage )
)ENGINE=InnoDB;

ALTER TABLE reservation ADD constraint FK_reservation_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE reservation ADD constraint FK_reservation_idcontratloc FOREIGN KEY (idcontratloc) REFERENCES contratlocation(idcontratloc);
ALTER TABLE logement ADD constraint FK_logement_idtype FOREIGN KEY (idtype) REFERENCES type(idtype);
ALTER TABLE logement ADD constraint FK_logement_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE logement ADD constraint FK_logement_idcontratlog FOREIGN KEY (idcontratlog) REFERENCES contratlogement(idcontratlog);
ALTER TABLE request ADD constraint FK_request_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE contratlocation ADD constraint FK_contratlocation_idlogement FOREIGN KEY (idlogement) REFERENCES logement(idlogement);
ALTER TABLE contratlocation ADD constraint FK_contratlocation_idreservation FOREIGN KEY (idreservation) REFERENCES reservation(idreservation);
ALTER TABLE contratlogement ADD constraint FK_contratlogement_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE contratlogement ADD constraint FK_contratlogement_idlogement FOREIGN KEY (idlogement) REFERENCES logement(idlogement);


INSERT into type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");

INSERT into `user` (`id`, `nom`, `prenom`, `email`, `password`, `civilite`, `adresse`, `ville`, `cp`, `tel`, `datebirth`, `status`, `createdate`) VALUES
  (1, 'DETEST', 'Joe', 'joe@test.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '27 rue Hector Bleu', 'VILLTANEUSE', 95250, '0134567542', '1985-03-06', 9, '2018-03-04'),
  (2, 'ARIST', 'Christian', 'christian@mail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mme', '43 rue Victor Vert', 'CROSNES', 91300, '0645342858', '1976-05-16', 0, '2018-03-04'),
  (3, 'BLANC', 'Jean', 'jean@blanc.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '24 rue bien', 'MARSEILLES', 13001, '0745676858', '1969-03-06', 1, '2018-04-04');

INSERT into `logement` (`idlogement`, `titre`, `emplacement`, `etage`, `prix`, `taille`, `idtype`, `caracteristique`, `id`, `photo`, `createdate`, `idcontratlog`, `status`) VALUES
(1, 'Chalet', 'Pyrénnées', '1er', '100', '62', 2, 'Beau', 1, './photos/c8eb3be435008b7d22e4225287de602c', '2018-03-04', NULL, 'valide'),
(2, 'Appartement Rustique', 'Jura', '3e', '135', '70', 1, 'Rustique, chaleureux, et plein ouest sur le flanc de la montagne. ', 2, './photos/61f30745a786ad5604c0bacf2ba0118d', '2018-04-03', NULL, 'valide'),
(3, 'Maison en Bois', 'Massif Central', '2 etages', '20', '145', 3, 'Dans un coin calme, au milieu de la nature', 2, './photos/0f113d9fde4be7527e057cd604db040a', '2018-04-04', NULL, 'valide'),
(4, 'Appartement Moderne', 'Vosges', '3e', '104', '63', 1, 'Exposé sud', 2, './photos/81d4003c390ad84970aa5e9490258312', '2018-04-05', NULL, 'valide'),
(5, 'Appartement', 'Alpes', '4e', '82', '23', 1, 'En zone rurale, proche des accès pistes', 1, './photos/eeb0b64ffb0d59468dde3737e74512a7', '2018-04-25', NULL, 'valide');

INSERT into `contratlogement` (`idcontratlog`,`id`,`idlogement`,`createdate`) VALUES
(1, 1, 1, '2018-03-03'),
(2, 2, 2, '2018-03-05'),
(3, 2, 3, '2018-03-05'),
(4, 2, 4, '2018-03-05'),
(5, 1, 5, '2018-04-06');

UPDATE `logement` SET idcontratlog = 1 WHERE idlogement = 1;
UPDATE `logement` SET idcontratlog = 2 WHERE idlogement = 2;
UPDATE `logement` SET idcontratlog = 3 WHERE idlogement = 3;
UPDATE `logement` SET idcontratlog = 4 WHERE idlogement = 4;
UPDATE `logement` SET idcontratlog = 5 WHERE idlogement = 5;

drop trigger if exists updaterequest;
delimiter //
create trigger updaterequest
after update on request
for each row
begin
declare validite text;
select status into validite
from request where request.idreq=old.idreq;
if validite = 'Valide user'
then
update user
set status='1'
where id=old.id;
end if;
if validite = 'Invalide user'
then
update user
set status='0'
where id=old.id;
end if;
if validite = 'Valide logement'
then
update logement
set status='valide'
where idlogement=old.idlogement;
insert into contratlogement(id,idlogement,createdate) values(new.id,new.idlogement,sysdate());
end if;
if validite = 'Invalide logement'
then
update logement
set status='invalide'
where idlogement=old.idlogement;
end if;
end //
delimiter ;

drop trigger if exists insertrequest;
delimiter //
create trigger insertrequest
after insert on logement
for each row
begin
declare mail varchar(150);
select user.email into mail
from user,logement
where user.id=logement.id and logement.idlogement=new.idlogement;
insert into request(createdate,id,email,idlogement) values(sysdate(),new.id,mail,new.idlogement);
end //
delimiter ;

drop trigger if exists gestcontratloc;
delimiter //
create trigger gestcontratloc
after insert on reservation
for each row
begin
insert into contratlocation(idreservation,idlogement,createdate) values(new.idreservation,new.idlogement,sysdate());
end //
delimiter ;

drop trigger if exists gestcontratlog;
delimiter //
create trigger gestcontratlog
after update on logement
for each row
begin
declare validite text;
select status into validite
from logement where logement.id=new.id;
if validite ='valide'
then
insert into contratlogement(id,idlogement,createdate) values(new.id,new.idlogement,sysdate());
update logement set idcontratlog=new.idcontratlog
where contratlogement.idlogement=logement.idlogement;
end if ;
end //
delimiter ;
