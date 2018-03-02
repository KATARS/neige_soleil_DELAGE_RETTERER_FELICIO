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
  status enum("valide","invalide","en attente") DEFAULT 'en attente',
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
  
create table requestuser (
  idrequ int auto_increment,
  createdate date,
  id int,
  email varchar(150),
  status enum('En attente','Valider','Refuser') DEFAULT 'En attente',
  primary key (idrequ),
  foreign key (id) references user(id),
  foreign key (email) references user(email));
  
  create table requestlogement (
  idreql int auto_increment,
  createdate date,
  id int,
  email varchar(150),
  status enum('En attente','Valide','Invalide') DEFAULT 'En attente',
  primary key (idreql),
  foreign key (id) references user(id),
  foreign key (email) references user(email));

INSERT INTO type(idtype,nom) VALUES
  (1,"Appartement"),
  (2,"Chalet"),
  (3,"Maison");
  
drop trigger if exists updateuser;
  delimiter //
  create trigger updateuser
  after update on requestuser
  for each row
  begin
  declare valide text ;
  select requestuser.status into valide
  from requestuser where requestuser.id=old.id ;
  if valide='Valider'
  then
  update user
  set user.status='1'
  where user.id=old.id ;
  end if;
  if valide='Refuser'
  then
  update user
  set user.status='0'
  where user.id=old.id ;
  end if ;
  end //
  delimiter ;


drop trigger if exists propositionlogement;
delimiter //
create trigger propositionlogement
after update on requestlogement
for each row 
begin 
declare validite text ;
select requestlogement.status into validite
from requestlogement where requestlogement.id=old.id ;
if validite='Valide'
then 
update logement 
set logement.status='Valide'
where logement.id=old.id ;
end if;
if validite='Invalide'
then 
update logement 
set logement.status='Invalide'
where logement.id=old.id ;
end if ;
end //
delimiter ;
