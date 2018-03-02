drop trigger if exists updateuser;
  delimiter //
  create trigger updateuser
  after update on requestuser
  for each row
  begin
  declare valide text ;
  select requestuser.status into valide
  from requestuser,user where requestuser.id=user.id ;
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
from requestlogement,logement where requestlogement.id=logement.id ;
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
