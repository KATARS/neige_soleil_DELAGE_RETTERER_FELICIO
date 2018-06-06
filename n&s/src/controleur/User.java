package controleur;

public class User {
	
	private int idUser,cp;
	private String adresse,ville,tel,datebirth,civilite,nom, prenom, email,status;
	
	public User()
	{
		this.idUser = 0;
		this.cp = 0;
		this.nom = "";
		this.prenom = "";
		this.email = "";
		this.status = "";
		this.adresse = "";
		this.ville = "";
		this.tel = "";
		this.datebirth = "";
		this.civilite = "";
	}
	public User (int idUser, String nom, String prenom, String email,String status,int cp,String adresse,
			String ville, String tel, String datebirth,String civilite)	{
		this.idUser = idUser;
		this.nom = nom;
		this.prenom = prenom;
		this.email = email;
		this.status = status;
		this.cp = cp;
		this.adresse = adresse;
		this.ville = ville;
		this.tel = tel;
		this.datebirth = datebirth;
		this.civilite = civilite;
	}
	public User(String nom, String prenom, String email,String status,int cp,String adresse,
			String ville, String tel, String datebirth,String civilite)
	{
		this.idUser = 0;
		this.nom = nom;
		this.prenom = prenom;
		this.email = email;
		this.status = status;
		this.cp = cp;
		this.adresse = adresse;
		this.ville = ville;
		this.tel = tel;
		this.datebirth = datebirth;
		this.civilite = civilite;
	}
	public User(String nom, String prenom, String email,String status,String adresse,
			String ville, String tel, String datebirth,String civilite)
	{
		this.idUser = 0;
		this.cp = 0;
		this.nom = nom;
		this.prenom = prenom;
		this.email = email;
		this.status = status;
		this.adresse = adresse;
		this.ville = ville;
		this.tel = tel;
		this.datebirth = datebirth;
		this.civilite = civilite;
	}
	public User(String status) {
		
		this.status = status;
	}
	public int getidUser() {
		return idUser;
	}
	public void setidUser(int idUser) {
		this.idUser = idUser;
	}
	public String getNom() {
		return nom;
	}
	public void setNom(String nom) {
		this.nom = nom;
	}
	public String getPrenom() {
		return prenom;
	}
	public void setPrenom(String prenom) {
		this.prenom = prenom;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getStatus() {
		return status;
	}
	public void setStatus(String status) {
		this.status = status;
	}
	public int getCp() {
		return cp;
	}
	public void setCp(int cp) {
		this.cp = cp;
	}
	public String getAdresse() {
		return adresse;
	}
	public void setAdresse(String adresse) {
		this.adresse = adresse;
	}
	public String getVille() {
		return ville;
	}
	public void setVille(String ville) {
		this.ville = ville;
	}
	public String getTel() {
		return tel;
	}
	public void setTel(String tel) {
		this.tel = tel;
	}
	public String getDatebirth() {
		return datebirth;
	}
	public void setDatebirth(String datebirth) {
		this.datebirth = datebirth;
	}
	public String getCivilite() {
		return civilite;
	}
	public void setCivilite(String civilite) {
		this.civilite = civilite;
	}

	
}
