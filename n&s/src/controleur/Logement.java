package controleur;

public class Logement {
	
	private int idlogement,idtype,id;
	private String titre, emplacement, etage,prix,taille,caracteristique
	,photo,status;
	public Logement()
	{
		this.idlogement = 0;
		this.idtype = 0;
		this.titre = "";
		this.emplacement = "";
		this.etage = "";
		this.prix = "";
		this.taille = "";
		this.caracteristique = "";
		this.photo = "";
		this.status="";
		
	}
	/*public Logement (int idlogement,int idtype, String titre,
			String emplacement, String etage,String prix,String taille,String caracteristique,
			String photo)	{
		this.idlogement = idlogement;
		this.idtype = idtype;
		this.titre = titre;
		this.emplacement = emplacement;
		this.etage = etage;
		this.prix = prix;
		this.taille = taille;
		this.caracteristique = caracteristique;
		this.photo = photo;
	}*/
	
	public Logement (int id,int idtype, String titre,
			String emplacement, String etage,String prix,String taille,String caracteristique,
			String photo,String status)
	{
		
		this.idlogement = 0;
		this.id=id;
		this.idtype = idtype;
		this.titre = titre;
		this.emplacement = emplacement;
		this.etage = etage;
		this.prix = prix;
		this.taille = taille;
		this.caracteristique = caracteristique;
		this.photo = photo;
		this.status = status;
	}
	public Logement (int idlogement,int id,int idtype, String titre,
			String emplacement, String etage,String prix,String taille,String caracteristique,
			String photo,String status)
	{
		
		this.idlogement = idlogement;
		this.id=id;
		this.idtype = idtype;
		this.titre = titre;
		this.emplacement = emplacement;
		this.etage = etage;
		this.prix = prix;
		this.taille = taille;
		this.caracteristique = caracteristique;
		this.photo = photo;
		this.status = status;
	}
	public int getIdlogement() {
		return idlogement;
	}
	public void setIdlogement(int idlogement) {
		this.idlogement = idlogement;
	}
	public int getIdtype() {
		return idtype;
	}
	public void setIdtype(int idtype) {
		this.idtype = idtype;
	}
	
	public String getTitre() {
		return titre;
	}
	public void setTitre(String titre) {
		this.titre = titre;
	}
	public String getEmplacement() {
		return emplacement;
	}
	public void setEmplacement(String emplacement) {
		this.emplacement = emplacement;
	}
	public String getEtage() {
		return etage;
	}
	public void setEtage(String etage) {
		this.etage = etage;
	}
	public String getPrix() {
		return prix;
	}
	public void setPrix(String prix) {
		this.prix = prix;
	}
	public String getTaille() {
		return taille;
	}
	public void setTaille(String taille) {
		this.taille = taille;
	}
	public String getCaracteristique() {
		return caracteristique;
	}
	public void setCaracteristique(String caracteristique) {
		this.caracteristique = caracteristique;
	}
	public String getPhoto() {
		return photo;
	}
	public void setPhoto(String photo) {
		this.photo = photo;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}


	
}
