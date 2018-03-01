drop database if exists neige;
create database neige;
  use neige;

create table user (
  id int auto_increment,
  nom text,
  prenom text,
  email varchar(150),
  password text,
  civilite enum("Mr","Mme"),
  adresse text,
  ville text,
  cp int(5),
  tel varchar(12),
  datebirth date,
  status int(1) default 0,
  createdate date,
  idreservation int,
  UNIQUE (email),
  primary key (id),
  foreign key (idreservation) references reservation(idreservation));

create table reservation (
  idreservation int auto_increment,
  datearr date,
  datedep date,
  id int,
  idlogement int,
  primary key (idreservation),
  foreign key (id) references user (id),
  foreign key (idlogement) references logement (idlogement));

create table logement (
  idlogement int auto_increment,
  titre varchar(150),
  emplacement text,
  etage text,
  prix text,
  taille text,
  idtype int,
  caracteristique text,
  id int ,
  photo text,
  createdate date,
  status enum("valide","invalide","en attente"),
  idreservation int,
  primary key (idlogement),
  foreign key (id) references user(id),
  foreign key (idreservation) references reservation(idreservation),
  foreign key (idtype) references type (idtype));

create table type (
  idtype int,
  nom text,
  primary key (idtype));

create table contrat_logement (
  idcontrat int auto_increment,
  id int,
  titre varchar(150),
  createdate date,
  primary key (idcontrat),
  foreign key (id) references user (id),
  foreign key (titre) references logement (titre));

create table request (
  idreq int auto_increment,
  createdate date,
  id int,
  email varchar(150),
  status enum("en attente","valider","refuser"),
  primary key (idreq),
  foreign key (id) references user(id),
  foreign key (email) references user(email));

INSERT INTO type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");
