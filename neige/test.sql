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
  UNIQUE (email),
  primary key (id));

create table logement (
  idlogement int auto_increment,
  titre text,
  emplacement text,
  etage text,
  prix text,
  taille text,
  idtype int,
  caracteristique text,
  id int ,
  photo text,
  createdate date,
  primary key (idlogement),
  foreign key (id) references user(id),
  foreign key (idtype) references type (idtype));

create table type (
  idtype int,
  nom text,
  primary key (idtype));

create table request (
  idreq int auto_increment,
  createdate date,
  id int,
  email varchar(150),
  primary key (idreq),
  foreign key (id) references user(id),
  foreign key (email) references user(email));

INSERT INTO type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");
