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

INSERT INTO `logement` (`idlogement`, `titre`, `emplacement`, `etage`, `prix`, `taille`, `idtype`, `caracteristique`, `id`, `photo`, `createdate`, `status`, `idreservation`) VALUES
  (1, 'Chalet Ancien Rustique', 'Alpes', '1 etage', '12EUR', '100', 2, 'Beau', 2, './photos/0364393c078aa2bed12e82f7c3fc9efc', '2018-03-04', 'en attente', NULL),
  (2, 'Chalet Ancien Rustique', 'Alpes', '1er', '12EUR', '100', 2, 'beau', 2, './photos/71ce3ce7b8df56795f26005b53bea16c', '2018-03-04', 'en attente', NULL),
  (3, 'Chalet Ancien Rustique', 'Alpes', '1er', '12EUR', '100', 2, 'beau', 2, './photos/455e981c88f0e5db165c03f7fa55eaa1', '2018-03-04', 'invalide', NULL),
  (4, 'Appartement Spacieux', 'Alpes', '1er', '11EUR', '100', 1, 'Beau', 1, './photos/c8eb3be435008b7d22e4225287de602c', '2018-03-04', 'valide', NULL);

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `civilite`, `adresse`, `ville`, `cp`, `tel`, `datebirth`, `status`, `createdate`, `idreservation`) VALUES
  (1, 'DETEST', 'Joe', 'joe@test.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '27 rue Hector Bleu', 'PARIS', 95300, '0745676858', '2018-03-06', 9, '2018-03-04', NULL),
  (2, 'BADI', 'Bado', 'bado@mail.test', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Mr', '24 rue bien', 'PARIS', 95300, '0745676858', '2018-03-06', 0, '2018-03-04', NULL);

--MDP des comptes : azerty


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
