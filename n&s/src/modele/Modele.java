package modele;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Formatter;

import javax.swing.JOptionPane;

import controleur.User;
import controleur.Contratlocation;
import controleur.Contratlogement;
import controleur.Logement;
import controleur.Statusreq;

public class Modele {
	

	public static String verifConnexion(String login,String mdp){
        String droits="";
        String requete="select count(*) as nb from user where email='"+login+"' and password='"+encryptPassword(mdp)+"' and status=9";
        Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
        //Bdd uneBdd=new Bdd("192.168.8.240","neige","thomas","thomas");
        try{
                uneBdd.seConnecter();
                Statement unStat=uneBdd.getMaConnexion().createStatement();
                ResultSet unRes=unStat.executeQuery(requete);
                System.out.println(unRes);
                if (unRes.next()){
                        int nb = unRes.getInt("nb");
                        if(nb>0){
                                droits = "admin";
                        }
                }
                unStat.close();
                unRes.close();
                uneBdd.seDeconnexter();
        }catch (SQLException exp){
                System.out.println("Erreur: "+requete);
                
        }
        return droits;
}

private static String encryptPassword(String password)
{
    String sha1 = "";
    try
    {
        MessageDigest crypt = MessageDigest.getInstance("SHA-1");
        crypt.reset();
        crypt.update(password.getBytes("UTF-8"));
        sha1 = byteToHex(crypt.digest());
    }
    catch(NoSuchAlgorithmException e)
    {
        e.printStackTrace();
    }
    catch(UnsupportedEncodingException e) 
    {
        e.printStackTrace();
    }
    return sha1;
}

private static String byteToHex(final byte[] hash)
{
    Formatter formatter = new Formatter();
    for (byte b : hash)
    {
        formatter.format("%02x", b);
    }
    String result = formatter.toString();
    formatter.close();
    return result;
}
	
	public static String byteArrayToHexString(byte[] b) {
		  String result = "";
		  for (int i=0; i < b.length; i++) {
		    result +=
		          Integer.toString( ( b[i] & 0xff ) + 0x100, 16).substring( 1 );
		  }
		  return result;
		}
	private static void exerequete(String requete){
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			unStat.execute(requete);
			unStat.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
	}

	

	public static ArrayList<User> selectAllUser(){
		ArrayList<User> lesUsers=new ArrayList<User>();
		String requete ="select id,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite from user;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int iduser=unRes.getInt("id");
				String nom=unRes.getString("nom");
				String prenom=unRes.getString("prenom");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				int cp = unRes.getInt("cp");
				String adresse = unRes.getString("adresse");
				String ville = unRes.getString("ville");
				String tel = unRes.getString("tel");
				String datebirth = unRes.getString("datebirth");
				String civilite = unRes.getString("civilite");
				User unUser=new User(iduser,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				lesUsers.add(unUser);
				
				
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesUsers;
		
	}
	


	public static void insertUser(User unUser){
		String requete ="insert into user(nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite) values('"+unUser.getNom()+"','"+unUser.getPrenom()+"','"+unUser.getEmail()+"',"
				+ ""+unUser.getStatus()+","+unUser.getCp()+",'"+unUser.getAdresse()+"','"+unUser.getVille()+"','"+unUser.getTel()+"','"+unUser.getDatebirth()+"','"+unUser.getCivilite()+"');";
		exerequete(requete);
	}
	
	public static void updateUser(User unUser){
		String requete ="update user set nom='"+unUser.getNom()+"',prenom ='"+unUser.getPrenom()+"',email='"+unUser.getEmail()+"',"
				+ "status="+unUser.getStatus()+",cp="+unUser.getCp()+",adresse='"+unUser.getAdresse()+"',ville='"+unUser.getVille()+"',tel='"+unUser.getTel()+"',datebirth='"+unUser.getDatebirth()+"'"
						+ ",civilite='"+unUser.getCivilite()+"' where id="+unUser.getidUser()+";";
		exerequete(requete);
	}
	public static void deleteUser(User unUser){
		String requete ="delete from user where id="+unUser.getidUser()+";";
		exerequete(requete);
	}
	
	
	public static ArrayList<User> selectUser(){
		ArrayList<User> lesUsers=new ArrayList<User>();
		String requete ="select id,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite from user where status=0;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int iduser=unRes.getInt("id");
				String nom=unRes.getString("nom");
				String prenom=unRes.getString("prenom");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				int cp = unRes.getInt("cp");
				String adresse = unRes.getString("adresse");
				String ville = unRes.getString("ville");
				String tel = unRes.getString("tel");
				String datebirth = unRes.getString("datebirth");
				String civilite = unRes.getString("civilite");
				User unUser=new User(iduser,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				lesUsers.add(unUser);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesUsers;
		
	}
	
	public static ArrayList<User> selectProp(){
		ArrayList<User> lesUsers=new ArrayList<User>();
		String requete ="select id,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite from user where status=1;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int iduser=unRes.getInt("id");
				String nom=unRes.getString("nom");
				String prenom=unRes.getString("prenom");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				int cp = unRes.getInt("cp");
				String adresse = unRes.getString("adresse");
				String ville = unRes.getString("ville");
				String tel = unRes.getString("tel");
				String datebirth = unRes.getString("datebirth");
				String civilite = unRes.getString("civilite");
				User unUser=new User(iduser,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				lesUsers.add(unUser);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesUsers;
		
	}
	
	public static ArrayList<User> selectAdmin(){
		ArrayList<User> lesUsers=new ArrayList<User>();
		String requete ="select id,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite from user where status=9;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int iduser=unRes.getInt("id");
				String nom=unRes.getString("nom");
				String prenom=unRes.getString("prenom");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				int cp = unRes.getInt("cp");
				String adresse = unRes.getString("adresse");
				String ville = unRes.getString("ville");
				String tel = unRes.getString("tel");
				String datebirth = unRes.getString("datebirth");
				String civilite = unRes.getString("civilite");
				User unUser=new User(iduser,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				lesUsers.add(unUser);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesUsers;
		
	}
	public static ArrayList<Statusreq> selectDemandestatus(){
		ArrayList<Statusreq> lesStatusreq=new ArrayList<Statusreq>();
		// on veut recuperer que les requ�tes des utilisateurs donc on veut pas les requetes de logements
		String requete ="select idreq,createdate,id,email,status from request where idlogement is null";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int idreq=unRes.getInt("idreq");
				String createdate=unRes.getString("createdate");
				int id=unRes.getInt("id");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				Statusreq unStatusreq=new Statusreq(idreq,createdate,id,email,status);
				lesStatusreq.add(unStatusreq);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesStatusreq;
		
	}
	
	public static ArrayList<Statusreq> selectDemandestatuslogement(){
		ArrayList<Statusreq> lesStatusreq=new ArrayList<Statusreq>();
		// on veut recuperer que les requ�tes des logements donc on veut des id logement non null
		String requete ="select idreq,createdate,id,email,idlogement,status from request where idlogement is not null";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int idreq=unRes.getInt("idreq");
				String createdate=unRes.getString("createdate");
				int id=unRes.getInt("id");
				String email=unRes.getString("email");
				int idlogement=unRes.getInt("idlogement");
				String status=unRes.getString("status");
				Statusreq unStatusreq=new Statusreq(idreq,createdate,id,email,idlogement,status);
				lesStatusreq.add(unStatusreq);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesStatusreq;
		
	}
	
	
	public static void validerReq(Statusreq unStatusreq){
		String requete ="update request set status='Valide user' where idreq="+unStatusreq.getIdreq()+";";
		exerequete(requete);
		System.out.println("erreur : "+requete);
	}
	
	public static void validerReqlog(Statusreq unStatusreq){
		String requete ="update request set status='Valide logement' where idreq="+unStatusreq.getIdreq()+";";
		exerequete(requete);
		System.out.println("erreur : "+requete);
	}

	
	public static ArrayList<Logement> selectAllLog(){
		ArrayList<Logement> leslogs=new ArrayList<Logement>();
		String requete2 ="select * from logement;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete2);
			while(unRes.next()){
				int id=unRes.getInt("id");
				int idlogement=unRes.getInt("idlogement");
				int idtype=unRes.getInt("idtype");
				String titre=unRes.getString("titre");
				String emplacement=unRes.getString("emplacement");
				String etage=unRes.getString("etage");
				String prix=unRes.getString("prix");
				String taille=unRes.getString("taille");
				String caracteristique=unRes.getString("caracteristique");
				String photo=unRes.getString("photo");
				String status=unRes.getString("status");
				Logement unLog=new Logement(idlogement,id,idtype,titre,emplacement,etage,prix,taille,
						caracteristique,photo,status);
				leslogs.add(unLog);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete2);
		}
		return leslogs;
		
	}
	public static void insertLog(Logement unLog){
		String requete2 ="insert into logement(idtype,titre,emplacement,etage,prix,"
				+ "taille,caracteristique,id,photo,status) "
				+ "values("+unLog.getIdtype()+",'"+unLog.getTitre()+"',"
						+ "'"+unLog.getEmplacement()+"'"
						+ ",'"+unLog.getEtage()+"','"+unLog.getPrix()+"','"+unLog.getTaille()+"','"+unLog.getCaracteristique()+"'"
								+ ","+unLog.getId()+",'"+unLog.getPhoto()+"','"+unLog.getStatus()+"');";
		exerequete(requete2);
	}
	public static void updateLog(Logement unLog){
		String requete2 ="update logement set idtype="+unLog.getIdtype()+",titre ='"+unLog.getTitre()+"',"
				+ "emplacement='"+unLog.getEmplacement()+"',etage ='"+unLog.getEtage()+"',prix ='"+unLog.getPrix()+"',taille ='"+unLog.getTaille()+"'"
						+ ",caracteristique ='"+unLog.getCaracteristique()+"',id ="+unLog.getId()+",photo ='"+unLog.getPhoto()+"',status ='"+unLog.getStatus()+"' where idlogement="+unLog.getIdlogement()+";";
		exerequete(requete2);
	}

	public static void deleteLog(Logement unLog) {
		String requete2 ="delete from logement where idlogement="+unLog.getIdlogement()+";";
		exerequete(requete2);
	}
	
	public static ArrayList<Contratlocation> selectAllContratloc(){
		ArrayList<Contratlocation> lesContratsloc=new ArrayList<Contratlocation>();
		String requete2 ="select * from contratlocation;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete2);
			while(unRes.next()){
				int idcontratloc=unRes.getInt("idcontratloc");
				int idreservation=unRes.getInt("idreservation");
				int idlogement=unRes.getInt("idlogement");
				String createdate = unRes.getString("createdate");

				Contratlocation unContratloc=new Contratlocation(idcontratloc,idreservation,idlogement,createdate);
				lesContratsloc.add(unContratloc);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete2);
		}
		return lesContratsloc;
		
	}
	public static ArrayList<Contratlogement> selectAllContratlog(){
		ArrayList<Contratlogement> lesContrats=new ArrayList<Contratlogement>();
		String requete ="select * from contratlogement;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int idcontratlog=unRes.getInt("idcontratlog");
				int id=unRes.getInt("id");
				int idlogement=unRes.getInt("idlogement");
				String createdate = unRes.getString("createdate");

				Contratlogement unContrat=new Contratlogement(idcontratlog,id,idlogement,createdate);
				lesContrats.add(unContrat);
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
			JOptionPane.showMessageDialog(null, exp.getMessage() + " " + exp.getErrorCode());
		}
		return lesContrats;
		
	}
	
		public static ArrayList<Contratlogement> selectallcontratprop(Contratlogement unContratlog) {
			ArrayList<Contratlogement> lesContrats=new ArrayList<Contratlogement>();
			String requete ="call afficher_contratlog_idprop("+unContratlog.getId()+");";
			Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
			try{
				uneBdd.seConnecter();
				Statement unStat=uneBdd.getMaConnexion().createStatement();
				ResultSet unRes=unStat.executeQuery(requete);
				while(unRes.next()){
					int idcontratlog=unRes.getInt("idcontratlog");
					int id=unRes.getInt("id");
					int idlogement=unRes.getInt("idlogement");
					String createdate = unRes.getString("createdate");

					Contratlogement unContrat=new Contratlogement(idcontratlog,id,idlogement,createdate);
					lesContrats.add(unContrat);
				}
				unStat.close();
				unRes.close();
				uneBdd.seDeconnexter();
			}catch(SQLException exp){
				System.out.println("erreur : "+requete);
				JOptionPane.showMessageDialog(null, exp.getMessage() + " " + exp.getErrorCode());
			}
			return lesContrats;
			
		}
		public static ArrayList<Contratlocation> selectallcontratres(Contratlocation unContratloc) {
			ArrayList<Contratlocation> lesContrats=new ArrayList<Contratlocation>();
			String requete ="call afficher_contratloc_idres("+unContratloc.getIdreservation()+");";
			Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","comard");
			try{
				uneBdd.seConnecter();
				Statement unStat=uneBdd.getMaConnexion().createStatement();
				ResultSet unRes=unStat.executeQuery(requete);
				while(unRes.next()){
					int idcontratlog=unRes.getInt("idcontratloc");
					int idreservation=unRes.getInt("idreservation");
					int idlogement=unRes.getInt("idlogement");
					String createdate = unRes.getString("createdate");

					Contratlocation unContrat=new Contratlocation(idcontratlog,idreservation,idlogement,createdate);
					lesContrats.add(unContrat);
				}
				unStat.close();
				unRes.close();
				uneBdd.seDeconnexter();
			}catch(SQLException exp){
				System.out.println("erreur : "+requete);
				JOptionPane.showMessageDialog(null, exp.getMessage() + " " + exp.getErrorCode());
			}
			return lesContrats;
			
		}
	

	
	/*
	 * 	public static ArrayList<User> selectAllUser(){
		ArrayList<User> lesUsers=new ArrayList<User>();
		String requete ="select id,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite from user;";
		Bdd uneBdd=new Bdd("mysql-katars.alwaysdata.net","katars_neige","katars","");
		try{
			uneBdd.seConnecter();
			Statement unStat=uneBdd.getMaConnexion().createStatement();
			ResultSet unRes=unStat.executeQuery(requete);
			while(unRes.next()){
				int iduser=unRes.getInt("id");
				String nom=unRes.getString("nom");
				String prenom=unRes.getString("prenom");
				String email=unRes.getString("email");
				String status=unRes.getString("status");
				int cp = unRes.getInt("cp");
				String adresse = unRes.getString("adresse");
				String ville = unRes.getString("ville");
				String tel = unRes.getString("tel");
				String datebirth = unRes.getString("datebirth");
				String civilite = unRes.getString("civilite");
				User unUser=new User(iduser,nom,prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				lesUsers.add(unUser);
				
				
			}
			unStat.close();
			unRes.close();
			uneBdd.seDeconnexter();
		}catch(SQLException exp){
			System.out.println("erreur : "+requete);
		}
		return lesUsers;
		
	}
	 */
}


