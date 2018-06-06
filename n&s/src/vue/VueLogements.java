package vue;

import java.awt.*;
import java.awt.event.*;
import java.sql.ResultSet;
import java.util.*;

import javax.swing.border.EmptyBorder;
import javax.swing.*;
import javax.swing.border.Border;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import controleur.User;
import controleur.Logement;
import controleur.Statusreq;
import controleur.Tableau;
import modele.Modele;

public class VueLogements extends JPanel implements ActionListener, MouseListener
{
	private JButton BtAjouter = new JButton("Ajouter");
	private JButton BtEditer = new JButton("Editer");
	private JButton BtSupprimer = new JButton("Supprimer");
	private JButton BtAnnuler = new JButton("Annuler");
	private JButton Btvalider = new JButton("Valider demande");
	private JButton Btrefuser = new JButton("Refuser demande");
	
	private JTextField txtIdLogement = new JTextField();
	private JTextField txtTitre = new JTextField();
	private JTextField txtEmplacement = new JTextField();
	private JTextField txtEtage = new JTextField();
	private JTextField txtPrix = new JTextField();
	private JTextField txtTaille = new JTextField();
	private JComboBox txtIdtype = new JComboBox();
	private JTextField txtCaracteristique = new JTextField();
	private JTextField txtIdprop = new JTextField();
	private JTextField txtPhoto = new JTextField();
	private JComboBox txtStatuslogement = new JComboBox();
	
	
	
	private JLabel lbdemandelogement = new JLabel("<html><center>Liste des logements <br>en demande de status</center></html>");
	private JTextField txtIdreq = new JTextField();
	private JLabel lbidreq = new JLabel("ID de la demande : ");
	private JLabel lbidlog  = new JLabel("   IdLogement:");
	private JLabel lbtitre = new JLabel("   Titre: ");
	private JLabel lbemplacement = new JLabel("   Emplacement:");
	private JLabel lbetage = new JLabel("   Etage:");
	private JLabel lbprix = new JLabel("   Prix:");
	private JLabel lbtaille = new JLabel("   Taille:");
	private JLabel lbtype = new JLabel("   Idtype:");
	private JLabel lbcarac = new JLabel("   Caracteristique:");
	private JLabel lbidprop = new JLabel("   Id prop:");
	private JLabel lbphoto = new JLabel("   Photo:");
	private JLabel lbstatuslogement = new JLabel("   status logement:");
	private JPanel unPanel = new JPanel();
	private JPanel unPaneldemandelogement = new JPanel();
	//declaration d'une JTable
	private JTable tableClients = new JTable();
	private Tableau unTableau;// objet de la table tableau
	
	private JTable tabledemandeStatus = new JTable();
	private Tableau unTableaustatuslog;
	
	public VueLogements()
	{
		this.setLayout(null);
		this.setBounds(0, 0, 1280, 720);
		this.setBackground(Color.white);
		
		
		//construction du panel admin
		this.unPanel.setLayout(null);

		this.unPanel.setBounds(0, 250, 640, 500);

		//construction du panel demande de status
		this.unPaneldemandelogement.setLayout(null);
		this.unPaneldemandelogement.setBounds(640, 250, 640, 500);
		
		
		this.txtStatuslogement.addItem("valide");
		this.txtStatuslogement.addItem("invalide");
		this.txtStatuslogement.addItem("en attente");
		
		this.txtIdtype.addItem(1);
		this.txtIdtype.addItem(2);
		this.txtIdtype.addItem(3);
		
		
		this.lbidlog.setBounds(0, 0, 200, 25);
		this.unPanel.add(lbidlog);
		this.txtIdLogement.setBounds(200, 0, 75, 25);
		this.unPanel.add(this.txtIdLogement);
		this.txtIdLogement.setEditable(false);
		
		this.lbtitre.setBounds(0, 25, 200, 25);
		this.unPanel.add(lbtitre);
		this.txtTitre.setBounds(200, 25, 150, 25);
		this.unPanel.add(this.txtTitre);
		
		this.lbemplacement.setBounds(0, 50, 200, 25);
		this.unPanel.add(lbemplacement);
		this.txtEmplacement.setBounds(200, 50, 150, 25);
		this.unPanel.add(this.txtEmplacement);
		
		
		this.lbetage.setBounds(0, 75, 200, 25);
		this.unPanel.add(lbetage);
		this.txtEtage.setBounds(200, 75, 150, 25);
		this.unPanel.add(this.txtEtage);
		
		
		
		this.lbprix.setBounds(0, 100, 200, 25);
		this.unPanel.add(lbprix);
		this.txtPrix.setBounds(200, 100, 150, 25);
		this.unPanel.add(this.txtPrix);
		
		this.lbtaille.setBounds(0, 125, 200, 25);
		this.unPanel.add(lbtaille);
		this.txtTaille.setBounds(200, 125, 150, 25);
		this.unPanel.add(this.txtTaille);
		
		this.lbtype.setBounds(0, 150, 200, 25);
		this.unPanel.add(lbtype);
		this.txtIdtype.setBounds(200, 150, 150, 25);
		this.unPanel.add(this.txtIdtype);
		
		this.lbcarac.setBounds(0, 175, 200, 25);
		this.unPanel.add(lbcarac);
		this.txtCaracteristique.setBounds(200, 175, 150, 25);
		this.unPanel.add(this.txtCaracteristique);
		
		this.lbidprop.setBounds(0, 200, 200, 25);
		this.unPanel.add(lbidprop);
		this.txtIdprop.setBounds(200, 200, 150, 25);
		this.unPanel.add(this.txtIdprop);
		
		this.lbphoto.setBounds(0, 225, 200, 25);
		this.unPanel.add(lbphoto);
		this.txtPhoto.setBounds(200, 225, 150, 25);
		this.unPanel.add(this.txtPhoto);
		
		this.lbstatuslogement.setBounds(0, 250, 200, 25);
		this.unPanel.add(lbstatuslogement);
		this.txtStatuslogement.setBounds(200, 250, 150, 25);
		this.unPanel.add(this.txtStatuslogement);
		
		this.BtAnnuler.setBounds(380, 50, 100, 25);
		this.unPanel.add(this.BtAnnuler);
		
		this.BtAjouter.setBounds(380, 140, 100, 25);
		this.unPanel.add(this.BtAjouter);
		
		this.BtEditer.setBounds(380, 110, 100, 25);
		this.unPanel.add(this.BtEditer);
		
		this.BtSupprimer.setBounds(380, 80, 100, 25);
		this.unPanel.add(this.BtSupprimer);
		
		this.BtAjouter.addActionListener(this);
		this.BtSupprimer.addActionListener(this);
		this.BtEditer.addActionListener(this);
		this.BtAnnuler.addActionListener(this);
		this.Btrefuser.addActionListener(this);
		this.BtAnnuler.addActionListener(this);
		this.Btvalider.addActionListener(this);
		
		
		
		//elements du block demande de status
		this.lbdemandelogement.setBounds(150,0,230,75);
		this.unPaneldemandelogement.add(this.lbdemandelogement);
		this.lbidreq.setBounds(0,275,240,50);
		this.unPaneldemandelogement.add(this.lbidreq);
		this.txtIdreq.setBounds(300,275,75,50);
		this.unPaneldemandelogement.add(this.txtIdreq);
		this.txtIdreq.setEditable(false);
		
		this.Btvalider.setBounds(150,350,150,50);
		this.unPaneldemandelogement.add(this.Btvalider);
		this.Btrefuser.setBounds(320,350,150,50);
		this.unPaneldemandelogement.add(this.Btrefuser);
		this.lbdemandelogement.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbidreq.setFont(new Font("Arial", Font.PLAIN, 20));
		String statusentete [] = {"ID demande","Date de creation", "ID user", "Email","ID logement","Status"};
		Object statusdonnees [][] = this.remplirDonneesdemandelogement();
		this.txtIdreq.setHorizontalAlignment(JTextField.CENTER);
		this.txtIdreq.setFont(new Font("Arial", Font.PLAIN, 20));
		
		
		this.unTableaustatuslog = new Tableau(statusdonnees, statusentete);
		this.tabledemandeStatus=new JTable(this.unTableaustatuslog);
		JScrollPane uneScroll1 = new JScrollPane(tabledemandeStatus);
		uneScroll1.setBounds(0, 75, 530, 200);
		unPaneldemandelogement.add(uneScroll1);
		this.unTableaustatuslog.refresh(statusdonnees);
		
		
		

		this.lbidlog.setHorizontalAlignment(JTextField.CENTER);
		this.lbtitre.setHorizontalAlignment(JTextField.CENTER);
		this.lbemplacement.setHorizontalAlignment(JTextField.CENTER);
		this.lbetage.setHorizontalAlignment(JTextField.CENTER);
		this.lbprix.setHorizontalAlignment(JTextField.CENTER);
		this.lbtaille.setHorizontalAlignment(JTextField.CENTER);
		this.lbtype.setHorizontalAlignment(JTextField.CENTER);
		this.lbcarac.setHorizontalAlignment(JTextField.CENTER);
		this.lbidprop.setHorizontalAlignment(JTextField.CENTER);
		this.lbphoto.setHorizontalAlignment(JTextField.CENTER);
		this.lbstatuslogement.setHorizontalAlignment(JTextField.CENTER);
		
		
		this.unPanel.setBackground(new Color(254,217,140));
		this.unPaneldemandelogement.setBackground(new Color(254,217,140));
		uneScroll1.getViewport().setBackground(new Color(254,217,140));
		this.lbidlog.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbtitre.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbemplacement.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbetage.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbprix.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbtaille.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbtype.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbcarac.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbidprop.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbphoto.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbphoto.setFont(new Font("Arial", Font.PLAIN, 20));
		this.lbstatuslogement.setFont(new Font("Arial", Font.PLAIN, 20));
		
		this.unPanel.setVisible(true);
		this.add(this.unPanel);
		this.unPaneldemandelogement.setVisible(true);
		this.add(this.unPaneldemandelogement);
		
	

				//this.unTableaustatuslog.refresh(statusdonnees);
		/*this.lbnom.setBounds(0, 50, 100, 50);
		this.unPanel.add(lbnom);
		
		this.txtNomClient.setBounds(100, 50, 150, 50);
		this.unPanel.add(this.txtNomClient);
		
		this.lbprenom.setBounds(0, 100, 100, 50);
		this.unPanel.add(lbprenom);
		
		this.txtPrenomClient.setBounds(100, 100, 150, 50);
		this.unPanel.add(this.txtPrenomClient);
		
		this.lbemail.setBounds(0, 150, 100, 50);
		this.unPanel.add(lbemail);
		
		this.txtEmailClient.setBounds(100, 150, 150, 50);
		this.unPanel.add(this.txtEmailClient);
		
		this.txtStatusClient.addItem(0);
		this.txtStatusClient.addItem(1);
		this.txtStatusClient.addItem(9);

		this.lbstatus.setBounds(0, 200, 100, 50);
		this.unPanel.add(lbstatus);
		
		this.txtStatusClient.setBounds(100, 200, 100, 50);
		this.unPanel.add(this.txtStatusClient);
		


		
		this.Btproprietaire.setBounds(450, 50, 200, 50);
		this.unPanel.add(this.Btproprietaire);
		
		this.Btclient.setBounds(450, 100, 200, 50);
		this.unPanel.add(this.Btclient);
		
		this.Btadmin.setBounds(450, 150, 200, 50);
		this.unPanel.add(this.Btadmin);
		
		this.Btuser.setBounds(450, 200, 200, 50);
		this.unPanel.add(this.Btuser);
		
		this.unPanel.setVisible(true);
		this.add(this.unPanel);
		
		this.Btadmin.addActionListener(this);
		this.Btproprietaire.addActionListener(this);
		this.Btuser.addActionListener(this);
		this.Btclient.addActionListener(this);

		*/
		//insertionde la table dans la fenetre
		String entete [] = {"id logement", "titre", "emplacement","etage", "prix","taille","type"
				,"caracteristique","id prop","photo","status"};
		Object donnees [][] = this.remplirDonnees();
		
		this.unTableau = new Tableau(donnees, entete);
		this.tableClients=new JTable(this.unTableau);
		
		JScrollPane uneScroll = new JScrollPane(tableClients);
		
		uneScroll.setBounds(0, 50, 1280, 200);
		uneScroll.getViewport().setBackground(new Color(254,217,140));
		this.add(uneScroll);
		//ajout d'un event de clique sur les lignes de la table
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
		this.tableClients.addMouseListener(new MouseListener() {
			
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
				int ligne = tableClients.getSelectedRow();
				txtIdLogement.setText(tableClients.getValueAt(ligne, 0).toString());
				txtTitre.setText(tableClients.getValueAt(ligne, 1).toString());
				txtEmplacement.setText(tableClients.getValueAt(ligne, 2).toString());
				txtEtage.setText(tableClients.getValueAt(ligne, 3).toString());
				txtPrix.setText(tableClients.getValueAt(ligne, 4).toString());
				txtTaille.setText(tableClients.getValueAt(ligne, 5).toString());
				txtIdtype.setSelectedItem(tableClients.getValueAt(ligne, 6));
				txtCaracteristique.setText(tableClients.getValueAt(ligne, 7).toString());
				txtIdprop.setText(tableClients.getValueAt(ligne, 8).toString());
				txtPhoto.setText(tableClients.getValueAt(ligne, 9).toString());
				txtStatuslogement.setSelectedItem(tableClients.getValueAt(ligne, 10));
				
				
			}
		});
		
		this.setVisible(false);
		
	}
/*	private JTextField txtIdLogement = new JTextField();
	private JTextField txtTitre = new JTextField();
	private JTextField txtEmplacement = new JTextField();
	private JTextField txtEtage = new JTextField();
	private JTextField txtPrix = new JTextField();
	private JTextField txtTaille = new JTextField();
	private JComboBox txtIdtype = new JComboBox();
	private JTextField txtCaracteristique = new JTextField();
	private JTextField txtIdprop = new JTextField();
	private JTextField txtPhoto = new JTextField();
	private JComboBox txtStatuslogement = new JComboBox();*/
	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.BtAjouter)
		{

			String titre = this.txtTitre.getText();
			String emplacement = this.txtEmplacement.getText();
			String etage = this.txtEtage.getText();
			String prix = this.txtPrix.getText();
			String taille = this.txtTaille.getText();
			int idtype = Integer.parseInt(this.txtIdtype.getSelectedItem().toString());
			String caracteristique = this.txtCaracteristique.getText();
			int proprietaire = Integer.parseInt(this.txtIdprop.getText());
			String photo = this.txtPhoto.getText();
			String status = this.txtStatuslogement.getSelectedItem().toString();
			if (titre.equals("") || emplacement.equals("") || etage.equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez remplir les donnees");
			}
			else 
			{
				//instanciation du logement
				Logement unLogement = new Logement(proprietaire,idtype,titre,emplacement,etage,prix,taille,caracteristique,photo,status);
				
				//appel de modele pour inserer un logement dans  la BDD
				Modele.insertLog(unLogement);
				JOptionPane.showMessageDialog(this, "Insertion réussie !");
				Object uneLigne[]={unLogement.getIdlogement(),unLogement.getTitre(),unLogement.getEmplacement(),unLogement.getEtage(),
						unLogement.getPrix(),unLogement.getPrix(),unLogement.getTaille(),unLogement.getIdtype(),unLogement.getCaracteristique(),
						unLogement.getPhoto(),unLogement.getStatus()};
				}
				this.txtTitre.setText("");
				this.txtEmplacement.setText("");
				this.txtEtage.setText("");
				this.txtPrix.setText("");
				this.txtTaille.setText("");
				this.txtCaracteristique.setText("");
				this.txtIdprop.setText("");
				this.txtPhoto.setText("");
				this.txtStatuslogement.getSelectedItem().toString();
				this.txtIdtype.getSelectedItem().toString();
				this.unTableau.refresh(remplirDonnees());
		}
				
				
				
				
				
				
				/*//Object donnees [][] = this.remplirDonnees();
				//this.unTableau.refresh(donnees);
				 // private JTable tableClients = new JTable();
				// private Tableau unTableau;// objet de la table tableau
				
			}*/
		else if (e.getSource() == this.BtSupprimer)
		{
			if (txtIdLogement.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez renseigner l'Id du logement");
			}
			else
			{
				int idlogement = Integer.parseInt(this.txtIdLogement.getText().toString());
				String titre = this.txtTitre.getText();
				String emplacement = this.txtEmplacement.getText();
				String etage = this.txtEtage.getText();
				String prix = this.txtPrix.getText();
				String taille = this.txtTaille.getText();
				int idtype = Integer.parseInt(this.txtIdtype.getSelectedItem().toString());
				String caracteristique = this.txtCaracteristique.getText();
				int proprietaire = Integer.parseInt(this.txtIdprop.getText());
				String photo = this.txtPhoto.getText();
				String status = this.txtStatuslogement.getSelectedItem().toString();
				//instanciation du logement
				Logement unLogement = new Logement(idlogement,proprietaire,idtype,titre,emplacement,etage,prix,taille,caracteristique,photo,status);
				
				//appel de modele pour supprimer un logement dans  la BDD
				Modele.deleteLog(unLogement);
				Object donnees [][] = this.remplirDonnees();
				this.unTableau.refresh(donnees);
				JOptionPane.showMessageDialog(this, "Suppression réussie !");
			}
		}

		else if (e.getSource() == this.BtEditer)
		{
			if (txtIdLogement.getText().equals(""))
			{
				JOptionPane.showMessageDialog(this, "Veuillez renseigner l'Id du logement");
			}
			else
			{
				int idlogement = Integer.parseInt(this.txtIdLogement.getText().toString());
				String titre = this.txtTitre.getText();
				String emplacement = this.txtEmplacement.getText();
				String etage = this.txtEtage.getText();
				String prix = this.txtPrix.getText();
				String taille = this.txtTaille.getText();
				int idtype = Integer.parseInt(this.txtIdtype.getSelectedItem().toString());
				String caracteristique = this.txtCaracteristique.getText();
				int proprietaire = Integer.parseInt(this.txtIdprop.getText());
				String photo = this.txtPhoto.getText();
				String status = this.txtStatuslogement.getSelectedItem().toString();
				//instanciation du logement
				Logement unLogement = new Logement(idlogement,proprietaire,idtype,titre,emplacement,etage,prix,taille,caracteristique,photo,status);
				
				//appel de modele pour editer un logement dans  la BDD
				Modele.updateLog(unLogement);
				Object donnees [][] = this.remplirDonnees();
				this.unTableau.refresh(donnees);
				JOptionPane.showMessageDialog(this, "MAJ réussie !");
			}
		}
		else if (e.getSource() == this.BtAnnuler)
		{
			this.txtTitre.setText("");
			this.txtEmplacement.setText("");
			this.txtEtage.setText("");
			this.txtPrix.setText("");
			this.txtTaille.setText("");
			this.txtCaracteristique.setText("");
			this.txtIdprop.setText("");
			this.txtPhoto.setText("");
			this.txtStatuslogement.getSelectedItem().toString();
			this.txtIdtype.getSelectedItem().toString();
		}
		else if (e.getSource() == this.Btvalider)
		{
			int idreq = Integer.parseInt(this.txtIdreq.getText());
			//instanciation du client
			Statusreq unStatusreq=new Statusreq(idreq);
				//appel de modele pour inserer un client dans  la BDD
				Modele.validerReqlog(unStatusreq);
				this.txtIdreq.setText("");
				Object donnees [][] = this.remplirDonneesdemandelogement();
				this.unTableaustatuslog.refresh(donnees);
				this.unTableau.refresh(remplirDonnees());
				
		}
		
		/*//this.unTableau.refresh(remplirDonnees());
		else if (e.getSource() == this.Btuser)
		{
			Object donnees [][] = this.remplirDonnees();
			this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btclient)
		{
			String nom = this.txtNomClient.getText();
			String prenom = this.txtPrenomClient.getText();
			String email = this.txtEmailClient.getText();
			String status = this.txtStatusClient.getSelectedItem().toString();
			//instanciation du client
			User unLogement = new User (nom, prenom,email,status);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectClient();
				this.txtNomClient.setText("");
				this.txtPrenomClient.setText("");
				this.txtEmailClient.setText("");
				Object donnees [][] = this.remplirDonneescli();
				this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btproprietaire)
		{
			String nom = this.txtNomClient.getText();
			String prenom = this.txtPrenomClient.getText();
			String email = this.txtEmailClient.getText();
			String status = this.txtStatusClient.getSelectedItem().toString();
			//instanciation du client
			User unLogement = new User (nom, prenom,email,status);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectProp();
				this.txtNomClient.setText("");
				this.txtPrenomClient.setText("");
				this.txtEmailClient.setText("");
				Object donnees [][] = this.remplirDonneesprop();
				this.unTableau.refresh(donnees);
		}
		else if (e.getSource() == this.Btadmin)
		{
			String nom = this.txtNomClient.getText();
			String prenom = this.txtPrenomClient.getText();
			String email = this.txtEmailClient.getText();
			String status = this.txtStatusClient.getSelectedItem().toString();
			//instanciation du client
			User unLogement = new User (nom, prenom,email,status);
				//appel de modele pour inserer un client dans  la BDD
				Modele.selectAdmin();
				this.txtNomClient.setText("");
				this.txtPrenomClient.setText("");
				this.txtEmailClient.setText("");
				Object donnees [][] = this.remplirDonneesadmin();
				this.unTableau.refresh(donnees);
		}*/
	}
	public Object[][] remplirDonnees()
	{
		ArrayList<Logement>lesLogements = Modele.selectAllLog();
		Object donnees [][] = new Object[lesLogements.size()][11];
		int i = 0;
		for (Logement unLogement : lesLogements)
		{
			donnees[i][0] = unLogement.getIdlogement() + "";
			donnees[i][1] = unLogement.getTitre();
			donnees[i][2] = unLogement.getEmplacement();
			donnees[i][3] = unLogement.getEtage();
			donnees[i][4] = unLogement.getPrix();
			donnees[i][5] = unLogement.getTaille();
			donnees[i][6] = unLogement.getIdtype() + "";
			donnees[i][7] = unLogement.getCaracteristique();
			donnees[i][8] = unLogement.getId() + "";
			donnees[i][9] = unLogement.getPhoto();
			donnees[i][10] = unLogement.getStatus();
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesdemandelogement()
	{
		ArrayList<Statusreq>lesStatusreq = Modele.selectDemandestatuslogement();
		Object donnees [][] = new Object[lesStatusreq.size()][6];
		int i = 0;
		for (Statusreq unStatusreq : lesStatusreq)
		{
			donnees[i][0] = unStatusreq.getIdreq();
			donnees[i][1] = unStatusreq.getCreatedate();
			donnees[i][2] = unStatusreq.getId();
			donnees[i][3] = unStatusreq.getEmail();
			donnees[i][4] = unStatusreq.getIdlogement();
			donnees[i][5] = unStatusreq.getStatus();

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
