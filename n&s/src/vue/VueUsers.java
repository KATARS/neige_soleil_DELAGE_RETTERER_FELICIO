package vue;

import java.awt.*;
import java.awt.event.*;

import java.util.*;


import javax.swing.JPanel;
import javax.swing.JButton;
import javax.swing.JTable;
import javax.swing.JLabel;
import javax.swing.JTextField;

import javax.swing.*;


import controleur.User;
import controleur.Statusreq;
import controleur.Tableau;
import modele.Modele;

public class VueUsers extends JPanel implements ActionListener, MouseListener
{
	private JButton BtAjouter = new JButton("Ajouter");
	private JButton BtEditer = new JButton("Editer");
	private JButton BtSupprimer = new JButton("Supprimer");
	private JButton BtAnnuler = new JButton("Annuler");
	private JButton Btproprietaire = new JButton("Proprietaires");
	private JButton Btclient = new JButton("Clients ");
	private JButton Btadmin = new JButton("Admins");
	private JButton Btuser = new JButton("tout les Users");
	
	private JButton Btvalider = new JButton("Valider demande");
	private JButton Btrefuser = new JButton("Refuser demande");
	
	private JTextField txtIdUser = new JTextField();
	private JTextField txtNom = new JTextField();
	private JTextField txtPrenom = new JTextField();
	private JTextField txtEmail = new JTextField();
	private JTextField txtdatebirth = new JTextField();
	private JTextField txtCP = new JTextField();
	private JTextField txtAdresse = new JTextField();
	private JTextField txtVille = new JTextField();
	private JTextField txtTel = new JTextField();
	private JTextField txtIdreq = new JTextField();
	private JComboBox txtStatusUser = new JComboBox();
	
	private JComboBox txtcivilite = new JComboBox();

	

	private JLabel lbnom  = new JLabel("   Nom:");
	private JLabel lbiduser = new JLabel("   Id Client: ");
	private JLabel lbprenom = new JLabel("   Prenom:");
	private JLabel lbemail = new JLabel("   Email:");
	private JLabel lbstatus = new JLabel("   Status:");

	private JLabel lbcp = new JLabel("   CP:");
	private JLabel lbAdresse = new JLabel("   Adresse:");
	private JLabel lbVille = new JLabel("   Ville:");
	private JLabel lbTel = new JLabel("   Tel:");
	private JLabel lbdatebirth = new JLabel("   Date de naissance:");
	private JLabel lbcivilite = new JLabel("   Civlite:");
	
	private JLabel lbinfostatus = new JLabel("<html>"
			+ "<p>Le status '0' correspond aux Utilisateurs</p></br>"
			+ "<p>Le status '1' correspond aux proprietaires</p></br>"
			+ "<p>Le status 9 correspond aux administrateurs</p></br>"
			+ "<p>Pour des raisons de sécurité il n'est pas possible d'ajouter des administateurs ici</p>"
			+ "</html>");
	

	private JLabel lbdemandestatus = new JLabel("<html><center>Liste des users <br>en demande de status pour passe proprietaire</center></html>");
	private JTextField txtIdUserstatus = new JTextField();
	
	private JLabel lbidreq  = new JLabel("   Choisir l'id demande:");
	
	private JPanel unPanel = new JPanel();
	private JPanel unPaneldemandestatus = new JPanel();
	//declaration d'une JTable
	private JTable tableUsers = new JTable();
	private JTable tabledemandeStatus = new JTable();
	private Tableau unTableau;// objet de la table tableau
	private Tableau unTableaustatus;
	public VueUsers()
	{
		this.setLayout(null);
		this.setBounds(0, 0, 1280, 720);
		this.setBackground(Color.white);
		
		
		//construction du panel principal user
		this.unPanel.setLayout(null);
		this.unPanel.setBounds(0, 250, 750, 500);
		
		//construction du panel demande de status
		this.unPaneldemandestatus.setLayout(null);
		this.unPaneldemandestatus.setBounds(750, 250, 530, 500);
		
		this.lbiduser.setBounds(0, 0, 200, 25);
		this.unPanel.add(lbiduser);
		this.txtIdUser.setBounds(200, 0, 75, 25);
		this.unPanel.add(this.txtIdUser);
		
		this.txtIdUser.setEditable(false);
		
		this.lbnom.setBounds(0, 25, 200, 25);
		this.unPanel.add(lbnom);
		
		this.txtNom.setBounds(200, 25, 150, 25);
		this.unPanel.add(this.txtNom);
		
		this.lbprenom.setBounds(0, 50, 200, 25);
		this.unPanel.add(lbprenom);
		
		this.txtPrenom.setBounds(200, 50, 150, 25);
		this.unPanel.add(this.txtPrenom);
		
		this.lbemail.setBounds(0, 75, 200, 25);
		this.unPanel.add(lbemail);
		
		this.txtEmail.setBounds(200, 75, 150, 25);
		this.unPanel.add(this.txtEmail);
		
		this.lbcp.setBounds(0, 100, 200, 25);
		this.unPanel.add(lbcp);
		
		this.txtCP.setBounds(200, 100, 150, 25);
		this.unPanel.add(this.txtCP);
		
		
		this.lbAdresse.setBounds(0, 125, 200, 25);
		this.unPanel.add(lbAdresse);
		
		this.txtAdresse.setBounds(200, 125, 150, 25);
		this.unPanel.add(this.txtAdresse);
		
		this.lbVille.setBounds(0, 150, 200, 25);
		this.unPanel.add(lbVille);
		
		this.txtVille.setBounds(200, 150, 150, 25);
		this.unPanel.add(this.txtVille);
		
		this.lbTel.setBounds(0, 175, 200, 25);
		this.unPanel.add(lbTel);
		
		this.txtTel.setBounds(200, 175, 150, 25);
		this.unPanel.add(this.txtTel);
		
		this.lbdatebirth.setBounds(0, 200, 200, 25);
		this.unPanel.add(lbdatebirth);
		
		this.txtdatebirth.setBounds(200, 200, 150, 25);
		this.unPanel.add(this.txtdatebirth);
		
		this.lbcivilite.setBounds(0, 225, 200, 25);
		this.unPanel.add(lbcivilite);
		
		this.txtcivilite.setBounds(200, 225, 150, 25);
		this.unPanel.add(this.txtcivilite);
		
		
		this.txtStatusUser.addItem(0);
		this.txtStatusUser.addItem(1);

		
		this.txtcivilite.addItem("Mr");
		this.txtcivilite.addItem("Mme");

		this.lbstatus.setBounds(50, 300, 150, 50);
		this.unPanel.add(lbstatus);
		
		this.txtStatusUser.setBounds(200, 300, 100, 50);
		this.unPanel.add(this.txtStatusUser);
		
		this.lbinfostatus.setBounds(350,250,400,120);
		this.unPanel.add(this.lbinfostatus);
		
		

		//elements du block demande de status
		this.lbdemandestatus.setBounds(150,0,230,75);
		this.unPaneldemandestatus.add(this.lbdemandestatus);
		this.lbidreq.setBounds(0,275,240,50);
		this.unPaneldemandestatus.add(this.lbidreq);
		this.txtIdreq.setBounds(300,275,75,50);
		this.unPaneldemandestatus.add(this.txtIdreq);
		this.txtIdreq.setEditable(false);
		
		this.Btvalider.setBounds(150,350,150,50);
		this.unPaneldemandestatus.add(this.Btvalider);
		this.Btrefuser.setBounds(320,350,150,50);
		this.unPaneldemandestatus.add(this.Btrefuser);
		this.lbdemandestatus.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbidreq.setFont(new Font("Arial", Font.PLAIN, 20));
		String statusentete [] = {"ID demande","Date de creation", "ID user", "Email","Status"};
		Object statusdonnees [][] = this.remplirDonneesdemande();
		this.txtIdreq.setHorizontalAlignment(JTextField.CENTER);
		this.txtIdreq.setFont(new Font("Arial", Font.PLAIN, 20));
		
		
		this.unTableaustatus = new Tableau(statusdonnees, statusentete);
		this.tabledemandeStatus=new JTable(this.unTableaustatus);
		JScrollPane uneScroll1 = new JScrollPane(tabledemandeStatus);
		uneScroll1.setBounds(0, 75, 530, 200);
		unPaneldemandestatus.add(uneScroll1);
		this.unTableaustatus.refresh(statusdonnees);
		
		
		this.lbiduser.setHorizontalAlignment(JTextField.CENTER);
		this.lbAdresse.setHorizontalAlignment(JTextField.CENTER);
		this.lbcivilite.setHorizontalAlignment(JTextField.CENTER);
		this.lbcp.setHorizontalAlignment(JTextField.CENTER);
		this.lbdatebirth.setHorizontalAlignment(JTextField.CENTER);
		this.lbemail.setHorizontalAlignment(JTextField.CENTER);
		this.lbnom.setHorizontalAlignment(JTextField.CENTER);
		this.lbprenom.setHorizontalAlignment(JTextField.CENTER);
		this.lbinfostatus.setHorizontalAlignment(JTextField.CENTER);
		this.lbVille.setHorizontalAlignment(JTextField.CENTER);
		this.lbTel.setHorizontalAlignment(JTextField.CENTER);
		
		
		this.lbAdresse.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbcivilite.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbcp.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbdatebirth.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbemail.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbiduser.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbnom.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbprenom.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbstatus.setFont(new Font("Arial", Font.PLAIN, 30));
		this.txtStatusUser.setFont(new Font("Arial", Font.PLAIN, 30));
		this.lbinfostatus.setFont(new Font("Arial", Font.PLAIN, 15));
		this.lbTel.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbVille.setFont(new Font("Arial", Font.PLAIN, 20));

		

		this.BtAnnuler.setBounds(380, 50, 100, 25);
		this.unPanel.add(this.BtAnnuler);
		
		this.BtAjouter.setBounds(380, 140, 100, 25);
		this.unPanel.add(this.BtAjouter);
		
		this.BtEditer.setBounds(380, 110, 100, 25);
		this.unPanel.add(this.BtEditer);
		
		this.BtSupprimer.setBounds(380, 80, 100, 25);
		this.unPanel.add(this.BtSupprimer);
		
		this.Btproprietaire.setBounds(500, 50, 150, 25);
		this.unPanel.add(this.Btproprietaire);
		
		this.Btclient.setBounds(500, 80, 150, 25);
		this.unPanel.add(this.Btclient);
		
		this.Btadmin.setBounds(500, 110, 150, 25);
		this.unPanel.add(this.Btadmin);
		
		this.Btuser.setBounds(500, 140, 150, 25);
		this.unPanel.add(this.Btuser);
		
		this.unPanel.setBackground(new Color(254,217,140));
		this.unPaneldemandestatus.setBackground(new Color(254,217,140));
		this.unPanel.setVisible(true);
		this.add(this.unPanel);
		
		this.unPaneldemandestatus.setVisible(true);
		this.add(this.unPaneldemandestatus);
		
		this.Btadmin.addActionListener(this);
		this.Btproprietaire.addActionListener(this);
		this.Btuser.addActionListener(this);
		this.Btclient.addActionListener(this);
		this.BtAjouter.addActionListener(this);
		this.BtSupprimer.addActionListener(this);
		this.BtEditer.addActionListener(this);
		this.BtAnnuler.addActionListener(this);
		
		this.Btvalider.addActionListener(this);
		this.Btrefuser.addActionListener(this);
		
		//insertionde la table dans la fenetre
		String entete [] = {"Id","civilite", "Nom", "Prenom","Email", "Adresse", "Ville", "CP", "tel", "date naissance", "Status"};
		Object donnees [][] = this.remplirDonnees();
		
		this.unTableau = new Tableau(donnees, entete);
		this.tableUsers=new JTable(this.unTableau);
		
		JScrollPane uneScroll = new JScrollPane(tableUsers);
		
		uneScroll.setBounds(0, 50, 1280, 200);
		uneScroll.getViewport().setBackground(new Color(254,217,140));
		this.add(uneScroll);

		this.unTableau.refresh(donnees);
		this.tabledemandeStatus.addMouseListener(new MouseListener() {
			
			@Override
			public void mouseReleased(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mousePressed(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseExited(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseEntered(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseClicked(MouseEvent e) {
				int lignestatus = tabledemandeStatus.getSelectedRow();
				txtIdreq.setText(tabledemandeStatus.getValueAt(lignestatus, 0).toString());
				
			}
		});
		//ajout d'un event de clique sur les lignes de la table
		this.tableUsers.addMouseListener(new MouseListener() {
			
			@Override
			public void mouseReleased(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mousePressed(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseExited(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseEntered(MouseEvent e) {
				// TODO Auto-generated method stub
				
			}
			
			@Override
			public void mouseClicked(MouseEvent e) {
				int ligne = tableUsers.getSelectedRow();
				txtIdUser.setText(tableUsers.getValueAt(ligne, 0).toString());
				txtcivilite.setSelectedItem(tableUsers.getValueAt(ligne, 1));
				txtNom.setText(tableUsers.getValueAt(ligne, 2).toString());
				txtPrenom.setText(tableUsers.getValueAt(ligne, 3).toString());
				txtEmail.setText(tableUsers.getValueAt(ligne, 4).toString());
				txtAdresse.setText(tableUsers.getValueAt(ligne, 5).toString());
				txtVille.setText(tableUsers.getValueAt(ligne, 6).toString());
				txtCP.setText(tableUsers.getValueAt(ligne, 7).toString());
				txtTel.setText(tableUsers.getValueAt(ligne, 8).toString());
				txtdatebirth.setText(tableUsers.getValueAt(ligne, 9).toString());
				txtStatusUser.setSelectedItem(tableUsers.getValueAt(ligne, 10));
			}
		});
		
		this.setVisible(false);
		
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.BtAjouter)
		{
			String nom = this.txtNom.getText();
			String prenom = this.txtPrenom.getText();
			String email = this.txtEmail.getText();
			String status = this.txtStatusUser.getSelectedItem().toString();
			String adresse = this.txtAdresse.getText();
			int cp = Integer.parseInt(this.txtCP.getText().toString());
			String ville = this.txtVille.getText();
			String tel = this.txtTel.getText();
		String datebirth = this.txtdatebirth.getText();
			String civilite = this.txtcivilite.getSelectedItem().toString();
			if (nom.equals("") || email.equals("") || prenom.equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez remplir les donnees");
			}
			else 
			{
				//instanciation du client
				User unUser = new User (nom, prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				
				//appel de modele pour inserer un client dans  la BDD
				Modele.insertUser(unUser);
				JOptionPane.showMessageDialog(this, "Insertion réussie !");
				Object uneLigne[]={unUser.getidUser(),unUser.getNom(),unUser.getPrenom(),unUser.getEmail(),unUser.getStatus(),unUser.getCp(),unUser.getVille(),
						unUser.getTel(),unUser.getDatebirth(),unUser.getCivilite()};
				this.txtNom.setText("");
				this.txtPrenom.setText("");
				this.txtEmail.setText("");
				this.txtStatusUser.getSelectedItem().toString();
				this.unTableau.refresh(remplirDonnees());
				
				
				
				
				
				
				//Object donnees [][] = this.remplirDonnees();
				//this.unTableau.refresh(donnees);
				 // private JTable tableUsers = new JTable();
				// private Tableau unTableau;// objet de la table tableau
				
			}
		}
		else if (e.getSource() == this.BtSupprimer)
		{
			if (txtIdUser.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez renseigner l'Id User");
			}
			else
			{
				int iduser = Integer.parseInt(this.txtIdUser.getText().toString());
				String nom = this.txtNom.getText();
				String prenom = this.txtPrenom.getText();
				String email = this.txtEmail.getText();
				String status = this.txtStatusUser.getSelectedItem().toString();
				String adresse = this.txtAdresse.getText();
				int cp = Integer.parseInt(this.txtCP.getText().toString());
				String ville = this.txtVille.getText();
				String tel = this.txtTel.getText();
				String datebirth = this.txtdatebirth.getText();
				String civilite = this.txtcivilite.getSelectedItem().toString();
				//instanciation du client
				User unUser = new User (iduser,nom, prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				
				//appel de modele pour inserer un client dans  la BDD
				Modele.deleteUser(unUser);
				Object donnees [][] = this.remplirDonnees();
				this.unTableau.refresh(donnees);
				JOptionPane.showMessageDialog(this, "Suppression réussie !");
			}
		}

		else if (e.getSource() == this.BtEditer)
		{
			if (txtIdUser.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez renseigner l'Id User");
			}
			else
			{
				int iduser = Integer.parseInt(this.txtIdUser.getText().toString());
				String nom = this.txtNom.getText();
				String prenom = this.txtPrenom.getText();
				String email = this.txtEmail.getText();
				String status = this.txtStatusUser.getSelectedItem().toString();
				String adresse = this.txtAdresse.getText();
				int cp = Integer.parseInt(this.txtCP.getText().toString());
				String ville = this.txtVille.getText();
				String tel = this.txtTel.getText();
				String datebirth = this.txtdatebirth.getText();
				String civilite = this.txtcivilite.getSelectedItem().toString();
				//instanciation du client
				User unUser = new User (iduser,nom, prenom,email,status,cp,adresse,ville,tel,datebirth,civilite);
				
				//appel de modele pour inserer un client dans  la BDD
				Modele.updateUser(unUser);
				Object donnees [][] = this.remplirDonnees();
				this.unTableau.refresh(donnees);
				JOptionPane.showMessageDialog(this, "MAJ réussie !");
			}
		}
		else if (e.getSource() == this.BtAnnuler)
		{
			this.txtIdUser.setText("");
			this.txtNom.setText("");
			this.txtPrenom.setText("");
			this.txtEmail.setText("");
		}
		
		//this.unTableau.refresh(remplirDonnees());
		else if (e.getSource() == this.Btuser)
		{
			Object donnees [][] = this.remplirDonnees();
			this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btclient)
		{
			String nom = this.txtNom.getText();
			String prenom = this.txtPrenom.getText();
			String email = this.txtEmail.getText();
			String status = this.txtStatusUser.getSelectedItem().toString();
			String adresse = this.txtAdresse.getText();
			String ville = this.txtVille.getText();
			String tel = this.txtTel.getText();
			String datebirth = this.txtdatebirth.getText();
			String civilite = this.txtcivilite.getSelectedItem().toString();
			//instanciation du client
			User unUser=new User(nom,prenom,email,status,adresse,ville,tel,datebirth,civilite);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectUser();
				this.txtNom.setText("");
				this.txtPrenom.setText("");
				this.txtEmail.setText("");
				Object donnees [][] = this.remplirDonneesuser();
				this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btproprietaire)
		{
			String nom = this.txtNom.getText();
			String prenom = this.txtPrenom.getText();
			String email = this.txtEmail.getText();
			String status = this.txtStatusUser.getSelectedItem().toString();
			String adresse = this.txtAdresse.getText();
			String ville = this.txtVille.getText();
			String tel = this.txtTel.getText();
			String datebirth = this.txtdatebirth.getText();
			String civilite = this.txtcivilite.getSelectedItem().toString();
			//instanciation du client
			User unUser=new User(nom,prenom,email,status,adresse,ville,tel,datebirth,civilite);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectProp();
				this.txtNom.setText("");
				this.txtPrenom.setText("");
				this.txtEmail.setText("");
				Object donnees [][] = this.remplirDonneesprop();
				this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btadmin)
		{
			String nom = this.txtNom.getText();
			String prenom = this.txtPrenom.getText();
			String email = this.txtEmail.getText();
			String status = this.txtStatusUser.getSelectedItem().toString();
			String adresse = this.txtAdresse.getText();
			String ville = this.txtVille.getText();
			String tel = this.txtTel.getText();
			String datebirth = this.txtdatebirth.getText();
			String civilite = this.txtcivilite.getSelectedItem().toString();
			//instanciation du client
			User unUser=new User(nom,prenom,email,status,adresse,ville,tel,datebirth,civilite);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectAdmin();
				this.txtNom.setText("");
				this.txtPrenom.setText("");
				this.txtEmail.setText("");
				Object donnees [][] = this.remplirDonneesadmin();
				this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btvalider)
		{
			int idreq = Integer.parseInt(this.txtIdreq.getText());
			//instanciation du client
			Statusreq unStatusreq=new Statusreq(idreq);
				//appel de modele pour inserer un client dans  la BDD
				Modele.validerReq(unStatusreq);
				this.txtIdreq.setText("");
				Object donnees [][] = this.remplirDonneesdemande();
				this.unTableaustatus.refresh(donnees);
				
		}
	}

	public Object[][] remplirDonnees()
	{
		ArrayList<User>lesUsers = Modele.selectAllUser();
		Object donnees [][] = new Object[lesUsers.size()][11];
		int i = 0;
		for (User unUser : lesUsers)
		{
			donnees[i][0] = unUser.getidUser() + "";
			donnees[i][1] = unUser.getCivilite();
			donnees[i][2] = unUser.getNom();
			donnees[i][3] = unUser.getPrenom();
			donnees[i][4] = unUser.getEmail();
			donnees[i][5] = unUser.getAdresse();
			donnees[i][6] = unUser.getVille();
			donnees[i][7] = unUser.getCp() + "";
			donnees[i][8] = unUser.getTel();
			donnees[i][9] = unUser.getDatebirth();
			donnees[i][10] = unUser.getStatus() + "";
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesuser()
	{
		ArrayList<User>lesUsers = Modele.selectUser();
		Object donnees [][] = new Object[lesUsers.size()][11];
		int i = 0;
		for (User unUser : lesUsers)
		{
			donnees[i][0] = unUser.getidUser() + "";
			donnees[i][1] = unUser.getCivilite();
			donnees[i][2] = unUser.getNom();
			donnees[i][3] = unUser.getPrenom();
			donnees[i][4] = unUser.getEmail();
			donnees[i][5] = unUser.getAdresse();
			donnees[i][6] = unUser.getVille();
			donnees[i][7] = unUser.getCp() + "";
			donnees[i][8] = unUser.getTel();
			donnees[i][9] = unUser.getDatebirth();
			donnees[i][10] = unUser.getStatus() + "";
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesprop()
	{
		ArrayList<User>lesUsers = Modele.selectProp();
		Object donnees [][] = new Object[lesUsers.size()][11];
		int i = 0;
		for (User unUser : lesUsers)
		{
			donnees[i][0] = unUser.getidUser() + "";
			donnees[i][1] = unUser.getCivilite();
			donnees[i][2] = unUser.getNom();
			donnees[i][3] = unUser.getPrenom();
			donnees[i][4] = unUser.getEmail();
			donnees[i][5] = unUser.getAdresse();
			donnees[i][6] = unUser.getVille();
			donnees[i][7] = unUser.getCp() + "";
			donnees[i][8] = unUser.getTel();
			donnees[i][9] = unUser.getDatebirth();
			donnees[i][10] = unUser.getStatus() + "";
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesadmin()
	{
		ArrayList<User>lesUsers = Modele.selectAdmin();
		Object donnees [][] = new Object[lesUsers.size()][11];
		int i = 0;
		for (User unUser : lesUsers)
		{
			donnees[i][0] = unUser.getidUser() + "";
			donnees[i][1] = unUser.getCivilite();
			donnees[i][2] = unUser.getNom();
			donnees[i][3] = unUser.getPrenom();
			donnees[i][4] = unUser.getEmail();
			donnees[i][5] = unUser.getAdresse();
			donnees[i][6] = unUser.getVille();
			donnees[i][7] = unUser.getCp() + "";
			donnees[i][8] = unUser.getTel();
			donnees[i][9] = unUser.getDatebirth();
			donnees[i][10] = unUser.getStatus() + "";
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesdemande()
	{
		ArrayList<Statusreq>lesStatusreq = Modele.selectDemandestatus();
		Object donnees [][] = new Object[lesStatusreq.size()][5];
		int i = 0;
		for (Statusreq unStatusreq : lesStatusreq)
		{
			donnees[i][0] = unStatusreq.getIdreq();
			donnees[i][1] = unStatusreq.getCreatedate();
			donnees[i][2] = unStatusreq.getId();
			donnees[i][3] = unStatusreq.getEmail();
			donnees[i][4] = unStatusreq.getStatus();

			i++;
		}
		return donnees;
	}

	@Override
	public void mouseClicked(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseEntered(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseExited(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mousePressed(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void mouseReleased(MouseEvent e) {
		// TODO Auto-generated method stub
		
	}
}
