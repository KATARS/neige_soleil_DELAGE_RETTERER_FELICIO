drop database if exists neige;
create database neige;
  use neige;

create table user(
        id         int (11) auto_increment  not null ,
        nom        text ,
        prenom     text ,
        email      varchar (150) ,
        password   text ,
        adresse    text ,
        ville      text ,
        cp         int ,
        tel        varchar (12) ,
        datebirth  date ,
        status     int ,
        createdate date ,
        civilite enum('Mr','Mme'),
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
        canceled      int ,
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
        idcontratlog    int ,
        status enum("valide","invalide","en attente") DEFAULT 'en attente',
        primary key (idlogement )
)ENGINE=InnoDB;

create table type(
        idtype int not null ,
        nom    varchar (25) ,
        primary key (idtype )
)ENGINE=InnoDB;

create table requestuser(
        idrequ int (11) auto_increment  not null ,
        idreq  int not null ,
        primary key (idrequ ,idreq )
)ENGINE=InnoDB;

create table requestlogement(
        idreql int (11) auto_increment  not null ,
        idreq  int not null ,
        primary key (idreql ,idreq )
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

create table admin(
        id int not null ,
        primary key (id )
)ENGINE=InnoDB;

create table client(
        id int not null ,
        primary key (id )
)ENGINE=InnoDB;

create table proprietaire(
        id int not null ,
        primary key (id )
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

ALTER TABLE reservation ADD CONSTRAint FK_reservation_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE reservation ADD CONSTRAint FK_reservation_idcontratloc FOREIGN KEY (idcontratloc) REFERENCES contratlocation(idcontratloc);
ALTER TABLE logement ADD CONSTRAint FK_logement_idtype FOREIGN KEY (idtype) REFERENCES type(idtype);
ALTER TABLE logement ADD CONSTRAint FK_logement_idcontratlog FOREIGN KEY (idcontratlog) REFERENCES contratlogement(idcontratlog);
ALTER TABLE requestuser ADD CONSTRAint FK_requestuser_idreq FOREIGN KEY (idreq) REFERENCES request(idreq);
ALTER TABLE requestlogement ADD CONSTRAint FK_requestlogement_idreq FOREIGN KEY (idreq) REFERENCES request(idreq);
ALTER TABLE request ADD CONSTRAint FK_request_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE admin ADD CONSTRAint FK_admin_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE client ADD CONSTRAint FK_client_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE proprietaire ADD CONSTRAint FK_proprietaire_id FOREIGN KEY (id) REFERENCES user(id);
ALTER TABLE contratlocation ADD CONSTRAint FK_contratlocation_idlogement FOREIGN KEY (idlogement) REFERENCES logement(idlogement);
ALTER TABLE contratlocation ADD CONSTRAint FK_contratlocation_idreservation FOREIGN KEY (idreservation) REFERENCES reservation(idreservation);
ALTER TABLE contratlogement ADD CONSTRAint FK_contratlogement_id FOREIGN KEY (id) REFERENCES user(id);


INSERT into type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");

INSERT into `user` (`id`, `nom`, `prenom`, `email`, `password`, `civilite`, `adresse`, `ville`, `cp`, `tel`, `datebirth`, `status`, `createdate`) VALUES
  (1, 'DETEST', 'Joe', 'joe@test.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '27 rue Hector Bleu', 'PARIS', 95300, '0745676858', '2018-03-06', 9, '2018-03-04'),
  (2, 'BADI', 'Bado', 'bado@mail.test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '24 rue bien', 'PARIS', 95300, '0745676858', '2018-03-06', 0, '2018-03-04');

INSERT into `logement` (`idlogement`, `titre`, `emplacement`, `etage`, `prix`, `taille`, `idtype`, `caracteristique`, `id`, `photo`, `createdate`, `idcontratlog`, `status`) VALUES
  (4, 'Chalet', 'Pyrénnées', '1er', '30EUR', '100', 2, 'Beau', 1, './photos/c8eb3be435008b7d22e4225287de602c', '2018-03-04', NULL, 'valide'),
  (5, 'Appartement Rustique', 'Jura', '3e', '28EUR', '70', 1, 'Rustique, chaleureux, et plein ouest sur le flanc de la montagne. ', 1, './photos/61f30745a786ad5604c0bacf2ba0118d', '2018-04-03', NULL, 'valide'),
  (6, 'Maison en Bois', 'Massif Central', '2 etages', '20EUR', '145', 3, 'Dans un coin calme, au milieu de la nature', 1, './photos/0f113d9fde4be7527e057cd604db040a', '2018-04-04', NULL, 'en attente');

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
