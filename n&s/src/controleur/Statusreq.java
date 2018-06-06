package controleur;

public class Statusreq {
	
	private int idreq,id,idlogement;
	private String createdate,email,status;
	
	public Statusreq()

	{
		this.idreq=0;
		this.id=0;
		this.idlogement=0;
		this.createdate="";
		this.email="";
		this.status="";
		
	}
	
	public Statusreq(int idreq)
	{
		this.idreq=idreq;
		
	}
	
	public Statusreq(int idreq,String createdate, int id,String email,String status)

	{
		this.idreq=idreq;
		this.id=id;
		this.createdate=createdate;
		this.email=email;
		this.status=status;
		
	}
	
	
	public Statusreq(int idreq,String createdate, int id,String email,int idlogement,String status)

	{
		this.idreq=idreq;
		this.id=id;
		this.createdate=createdate;
		this.email=email;
		this.idlogement=idlogement;
		this.status=status;
		
	}

	public int getIdreq() {
		return idreq;
	}

	public void setIdreq(int idreq) {
		this.idreq = idreq;
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

}
