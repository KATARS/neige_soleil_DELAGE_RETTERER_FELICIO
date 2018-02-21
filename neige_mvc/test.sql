drop database if exists test;
create database test;
  use test;

create table user (
  id int auto_increment not null,
  nom varchar(100),
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
  UNIQUE (email),
  primary key (id));

create table logement (
  idlogement int auto_increment,
  titre text,
  emplacement text,
  etage text,
  prix text,
  taille text,
  type text,
  caracteristique text,
  id int not null,
  primary key (idlogement),
  foreign key (id) references user(id));
