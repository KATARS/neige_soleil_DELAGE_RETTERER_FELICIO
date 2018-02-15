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
