drop database if exists neige_soleil;
create database neige_soleil;
        use neige_soleil;

create table proprietaires(
        id int(10)   not null,
        email varchar(50) not null,
        mdp text not null,
        nom    varchar (25),
        prenom varchar (25),
        tel    varchar (10),
        adresse varchar (200),
        status varchar(3),
        PRIMARY KEY (id))
ENGINE=InnoDB;

create table contrats(
        numContrat int(10) auto_increment  not null,
        typeContrat varchar(25),
        datedebutContrat date,
        datefinContrat date,
        id int(10),
        idL int(10),
        numsaison int(10),
        PRIMARY KEY (numContrat))
ENGINE=InnoDB;

create table logements(
        idL          int(10) auto_increment  not null,
        typeL        varchar (25),
        tailleL      float,
        emplacementL varchar(25),
        etageL       int(10),
        caracL       text,
        photosL      text,
        prixL        float,
        PRIMARY KEY (idL))
ENGINE=InnoDB;

create table equipements(
        idE            int(10) auto_increment  not null,
        disponibiliteE varchar(25),
        nomE          float,
        PRIMARY KEY (idE))
ENGINE=InnoDB;

create table clients(
        id int(10) not null,
        email varchar(50) not null,
        mdp text not null,
        nom    varchar (25),
        prenom varchar (25),
        tel    varchar (10),
        adresse varchar (200),
        status varchar(3),
        idCat int(10),
        PRIMARY KEY (id))
ENGINE=InnoDB;

create table utilisateur(
        id     int(10)  not null,
        email varchar(50) not null,
        mdp text not null,
        nom    varchar (25),
        prenom varchar (25),
        tel    varchar (10),
        adresse varchar (200),
        status varchar(3),
        PRIMARY KEY (id))
ENGINE=InnoDB;

create table categorie_socio(
        idCat  int (10) auto_increment  not null ,
        nomCat Varchar (50) ,
        PRIMARY KEY (idCat))
ENGINE=InnoDB;

create table contrats_location(
        numCL       int(10) auto_increment  not null,
        typeCL      varchar(25),
        datedebutCL date,
        datefinCL   date,
        idL         int(10),
        id          int(10),
        numsaison   int(10),
        PRIMARY KEY (numCL))
ENGINE=InnoDB;

create table saison(
        numsaison   int(10) not null,
        libelle     varchar (50),
        pourcentage float,
        PRIMARY KEY (numsaison))
ENGINE=InnoDB;

create table admin(
        id int(10) not null,
        email varchar(50) not null,
        mdp text not null,
        nom    varchar (25),
        prenom varchar (25),
        tel    varchar (10),
        adresse varchar (200),
        status varchar(3),
        PRIMARY KEY (id))
ENGINE=InnoDB;

create table locatif(
        prixE  Float not null ,
        idE    int not null ,
        idPres int ,
        PRIMARY KEY (idE))
ENGINE=InnoDB;

create table menager(
        idE int not null ,
        PRIMARY KEY (idE))
ENGINE=InnoDB;

create table prestataire(
        idPres  int (11) Auto_increment  not null ,
        nomPres Varchar (25) ,
        PRIMARY KEY (idPres))
ENGINE=InnoDB;

create table concerner(
        idE        int(10) not null,
        numContrat int(10) not null,
        PRIMARY KEY (idE ,numContrat))
ENGINE=InnoDB;

create table correspondre(
        numCL int(10) not null,
        idE   int(10) not null,
        PRIMARY KEY (numCL, idE))
ENGINE=InnoDB;

ALTER TABLE proprietaires ADD CONSTRAint FK_proprietaires_id FOREIGN KEY (id) REFERENCES utilisateur(id);
ALTER TABLE contrats ADD CONSTRAint FK_contrats_id FOREIGN KEY (id) REFERENCES utilisateur(id);
ALTER TABLE contrats ADD CONSTRAint FK_contrats_idL FOREIGN KEY (idL) REFERENCES logements(idL);
ALTER TABLE contrats ADD CONSTRAint FK_contrats_numsaison FOREIGN KEY (numsaison) REFERENCES saison(numsaison);
ALTER TABLE clients ADD CONSTRAint FK_clients_id FOREIGN KEY (id) REFERENCES utilisateur(id);
ALTER TABLE clients ADD CONSTRAint FK_clients_idCat FOREIGN KEY (idCat) REFERENCES categorie_socio(idCat);
ALTER TABLE contrats_location ADD CONSTRAint FK_contrats_location_idL FOREIGN KEY (idL) REFERENCES logements(idL);
ALTER TABLE contrats_location ADD CONSTRAint FK_contrats_location_id FOREIGN KEY (id) REFERENCES utilisateur(id);
ALTER TABLE contrats_location ADD CONSTRAint FK_contrats_location_numsaison FOREIGN KEY (numsaison) REFERENCES saison(numsaison);
ALTER TABLE admin ADD CONSTRAint FK_admin_id FOREIGN KEY (id) REFERENCES utilisateur(id);
ALTER TABLE locatif ADD CONSTRAint FK_locatif_idE FOREIGN KEY (idE) REFERENCES equipements(idE);
ALTER TABLE locatif ADD CONSTRAint FK_locatif_idPres FOREIGN KEY (idPres) REFERENCES prestataire(idPres);
ALTER TABLE menager ADD CONSTRAint FK_menager_idE FOREIGN KEY (idE) REFERENCES equipements(idE);
ALTER TABLE concerner ADD CONSTRAint FK_concerner_idE FOREIGN KEY (idE) REFERENCES equipements(idE);
ALTER TABLE concerner ADD CONSTRAint FK_concerner_numContrat FOREIGN KEY (numContrat) REFERENCES contrats(numContrat);
ALTER TABLE correspondre ADD CONSTRAint FK_correspondre_numCL FOREIGN KEY (numCL) REFERENCES contrats_location(numCL);
ALTER TABLE correspondre ADD CONSTRAint FK_correspondre_idE FOREIGN KEY (idE) REFERENCES equipements(idE);


drop trigger if exists insertclient;
delimiter //
create trigger insertclient
before insert on clients 
for each row 
begin 
declare nu,na,np int;
select count(*) into nu
from utilisateur 
where id=new.id;
if nu=0
then insert into utilisateur(id,email,mdp,nom,prenom,tel,adresse)
values(new.id,new.email,new.mdp,new.nom,new.prenom,new.tel,new.adresse);
end if;
select count(*) into na
from admin where id=new.id;
if na>0
then signal sqlstate'42000'
set message_text='cet utilisateur est deja present dans la table admin';
end if ;
select count(*) into np
from proprietaires where id=new.id;
if np>0
then signal sqlstate'42000'
set message_text='cet utilisateur est deja present dans la table proprietaire';
end if ;
end //
delimiter ;
