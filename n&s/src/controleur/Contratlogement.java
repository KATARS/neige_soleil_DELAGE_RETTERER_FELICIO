package controleur;

public class Contratlogement {
	int idcontratlog,id,idlogement;
	String createdate;
	
	public Contratlogement()
	{
		this.idcontratlog=0;
		this.id=0;
		this.idlogement=0;
		this.createdate="";
	}
	public Contratlogement(int idcontratlog, int id, int idlogement,String createdate)
	{
		this.idcontratlog=idcontratlog;
		this.id=id;
		this.idlogement=idlogement;
		this.createdate=createdate;
	}
	public Contratlogement(int id)
	{
		this.id=id;
	}
	public int getIdcontratlog() {
		return idcontratlog;
	}
	public void setIdcontratlog(int idcontratlog) {
		this.idcontratlog = idcontratlog;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
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
