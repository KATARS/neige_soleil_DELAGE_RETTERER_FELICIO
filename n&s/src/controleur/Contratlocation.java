package controleur;

public class Contratlocation {
	int idcontratloc,idreservation,idlogement;
	String createdate;
	
	public Contratlocation()
	{
		this.idcontratloc=0;
		this.idreservation=0;
		this.idlogement=0;
		this.createdate="";
	}
	public Contratlocation(int idcontratloc, int idreservation, int idlogement,String createdate)
	{
		this.idcontratloc=idcontratloc;
		this.idreservation=idreservation;
		this.idlogement=idlogement;
		this.createdate=createdate;
	}
	
	public Contratlocation(int idreservation)
	{
		this.idreservation=idreservation;
	}
	public int getIdcontratloc() {
		return idcontratloc;
	}
	public void setIdcontratloc(int idcontratloc) {
		this.idcontratloc = idcontratloc;
	}
	public int getIdreservation() {
		return idreservation;
	}
	public void setId(int id) {
		this.idreservation = idreservation;
	}
	public int getIdlogement() {
		return idlogement;
	}
	public void setIdlogement(int idlogement) {
		this.idlogement = idlogement;
	}
	public String getCreatedate() {
		return createdate;
	}
	public void setCreatedate(String createdate) {
		this.createdate = createdate;
	}
	


}