drop database if exists test;
create database test;
  use test;

create table user (
  id int auto_increment not null,
  nom text,
  prenom text,
  email text,
  password text,
  civilite enum("Mr","Mme"),
  adresse text,
  ville text,
  cp int(5),
  tel varchar(12),
  datebirth date,
  status int(1) default 0,
  primary key (id));

create table logement (
  id int auto_increment not null,
  titre text,
  emplacement text,
  etage text,
  prix text,
  taille text,
  type text,
  caracteristique text,
  primary key (id));
