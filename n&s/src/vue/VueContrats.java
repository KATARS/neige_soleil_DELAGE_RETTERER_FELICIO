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
import controleur.Contratlocation;
import controleur.Contratlogement;
import controleur.Statusreq;
import controleur.Tableau;
import modele.Modele;

public class VueContrats extends JPanel implements ActionListener, MouseListener
{

	
	
	private JButton rechercheridprop = new JButton("Rechercher");
	private JButton rechercheridres = new JButton("Rechercher");
	private JButton affichercontratlog = new JButton("Tout afficher");
	private JButton  affichercontratloc = new JButton("Tout afficher");
	private JLabel lbcontratloc = new JLabel("<html><center>Liste des contrats de Locations</center></html>");
	private JLabel lbcontratlog = new JLabel("<html><center>Liste des contrats de Logements</center></html>");
	private JPanel unPanelContratloc = new JPanel();
	private JPanel unPanelContratlog = new JPanel();
	
	private JTextField txtrechercheridprop = new JTextField();
	private JTextField txtrechercheridres = new JTextField();
	
	private JLabel lbrechercheridprop = new JLabel("ID du proprietaire à chercher");
	private JLabel lbrechercheridres = new JLabel("ID de la reservation à chercher");
	
	//declaration d'une JTable
	private JTable tableContratlog = new JTable();
	private Tableau unTableaustatuslog;// objet de la table tableau
	
	private JTable tableContratloc = new JTable();
	private Tableau unTableauloc;
	
	public VueContrats()
	{
		this.setLayout(null);
		this.setBounds(0, 0, 1280, 720);
		this.setBackground(Color.white);
		
		
		//construction du panel admin
		this.unPanelContratloc.setLayout(null);
		this.unPanelContratloc.setBounds(0, 50, 640, 720);
		this.unPanelContratlog.setLayout(null);
		this.unPanelContratlog.setBounds(640, 50, 640, 720);
		
		
		this.lbrechercheridres.setBounds(0,550,200,50);
		this.unPanelContratlog.add(this.lbrechercheridres);
		this.lbrechercheridprop.setBounds(0,550,200,50);
		this.unPanelContratloc.add(this.lbrechercheridprop);
		
		this.txtrechercheridres.setBounds(200,550,100,50);
		this.unPanelContratlog.add(this.txtrechercheridres);
		this.txtrechercheridprop.setBounds(200,550,100,50);
		this.unPanelContratloc.add(this.txtrechercheridprop);
		this.lbcontratloc.setBounds(220,0,220,150);
		this.unPanelContratlog.add(this.lbcontratloc);
		this.lbcontratlog.setBounds(220,0,220,150);
		this.unPanelContratloc.add(this.lbcontratlog);
		
		
		this.rechercheridres.setBounds(320,550,110,50);
		this.unPanelContratlog.add(this.rechercheridres);
		this.affichercontratloc.setBounds(430,550,110,50);
		this.unPanelContratlog.add(this.affichercontratloc);
		
		this.rechercheridprop.setBounds(320,550,110,50);
		this.unPanelContratloc.add(this.rechercheridprop);
		this.affichercontratlog.setBounds(430,550,110,50);
		this.unPanelContratloc.add(this.affichercontratlog);
		
		this.lbcontratloc.setFont(new Font("Arial", Font.PLAIN, 30));
		this.lbcontratlog.setFont(new Font("Arial", Font.PLAIN, 30));
		this.lbrechercheridprop.setFont(new Font("Arial", Font.PLAIN, 15));
		this.lbrechercheridres.setFont(new Font("Arial", Font.PLAIN, 15));
		String enteteloc [] = {"ID contrat location","ID reservation","ID logement","Date de creation"};
		Object donneesloc [][] = this.remplirDonneesContratloc();

		
		
		this.unTableauloc = new Tableau(donneesloc, enteteloc);
		this.tableContratloc=new JTable(this.unTableauloc);
		JScrollPane uneScroll1 = new JScrollPane(tableContratloc);
		uneScroll1.setBounds(20, 150, 600, 400);
		unPanelContratlog.add(uneScroll1);
		this.unTableauloc.refresh(donneesloc);
		
		
		
		this.affichercontratloc.addActionListener(this);
		this.affichercontratlog.addActionListener(this);
		this.rechercheridprop.addActionListener(this);
		this.rechercheridres.addActionListener(this);
		
		this.unPanelContratloc.setBackground(new Color(254,217,140));
		this.unPanelContratlog.setBackground(new Color(254,217,140));
		uneScroll1.getViewport().setBackground(new Color(254,217,140));
		
		this.unPanelContratloc.setVisible(true);
		this.add(this.unPanelContratloc);
		this.unPanelContratlog.setVisible(true);
		this.add(this.unPanelContratlog);
		
		
		
		String entetelog [] = {"ID contrat Logement","ID proprietaire","ID logement","Date de creation"};
		Object donneeslog [][] = this.remplirDonneesContratlog();
		
		this.unTableaustatuslog = new Tableau(donneeslog, entetelog);
		this.tableContratlog=new JTable(this.unTableaustatuslog);
		
		JScrollPane uneScroll = new JScrollPane(tableContratlog);
		this.unTableaustatuslog.refresh(donneeslog);
		uneScroll.setBounds(20, 150, 600, 400);
		uneScroll.getViewport().setBackground(new Color(254,217,140));
		this.unPanelContratloc.add(uneScroll);
		//ajout d'un event de clique sur les lignes de la table
		this.tableContratloc.addMouseListener(new MouseListener() {
			
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

				
			}
		});
		this.tableContratlog.addMouseListener(new MouseListener() {
			
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
				int ligne = tableContratlog.getSelectedRow();
				
				
			}
		});
		
		this.setVisible(false);
		
	}


	public Object[][] remplirDonneesContratlog()
	{
		ArrayList<Contratlogement>lesContrats = Modele.selectAllContratlog();
		Object donnees [][] = new Object[lesContrats.size()][4];
		int i = 0;
		for (Contratlogement unContrat : lesContrats)
		{
			donnees[i][0] = unContrat.getIdcontratlog() + "";
			donnees[i][1] = unContrat.getId();
			donnees[i][2] = unContrat.getIdlogement();
			donnees[i][3] = unContrat.getCreatedate();
			i++;
		}
		return donnees;
	}
	
	public Object[][] remplirDonneesrechercheContratlog(Contratlogement unContratlog)
	{
		int id= Integer.parseInt(this.txtrechercheridprop.getText().toString()); 
		ArrayList<Contratlogement>lesContrats = Modele.selectallcontratprop(unContratlog);
		Object donnees [][] = new Object[lesContrats.size()][4];
		int i = 0;
		for (Contratlogement unContrat : lesContrats)
		{
			donnees[i][0] = unContrat.getIdcontratlog() + "";
			donnees[i][1] = unContrat.getId();
			donnees[i][2] = unContrat.getIdlogement();
			donnees[i][3] = unContrat.getCreatedate();
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesrechercheContratloc(Contratlocation unContratloc)
	{
		ArrayList<Contratlocation>lesContrats = Modele.selectallcontratres(unContratloc);
		Object donnees [][] = new Object[lesContrats.size()][4];
		int i = 0;
		for (Contratlocation unContrat : lesContrats)
		{
			donnees[i][0] = unContrat.getIdcontratloc() + "";
			donnees[i][1] = unContrat.getIdreservation();
			donnees[i][2] = unContrat.getIdlogement();
			donnees[i][3] = unContrat.getCreatedate();
			i++;
		}
		return donnees;
	}
	public Object[][] remplirDonneesContratloc()
	{
		ArrayList<Contratlocation>lesContrats = Modele.selectAllContratloc();
		Object donnees [][] = new Object[lesContrats.size()][4];
		int i = 0;
		for (Contratlocation unContrat : lesContrats)
		{
			donnees[i][0] = unContrat.getIdcontratloc() + "";
			donnees[i][1] = unContrat.getIdreservation();
			donnees[i][2] = unContrat.getIdlogement();
			donnees[i][3] = unContrat.getCreatedate();

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


	@Override
	public void actionPerformed(ActionEvent e) {
		if (e.getSource() == this.rechercheridprop)
		{

			int id = Integer.parseInt(this.txtrechercheridprop.getText());
				Contratlogement unContralog = new Contratlogement(id);
				Modele.selectallcontratprop(unContralog);
				Object uneLigne[]={unContralog.getIdcontratlog(),unContralog.getId(),unContralog.getIdlogement(),unContralog.getCreatedate()};
				Object donnees [][] = this.remplirDonneesrechercheContratlog(unContralog);
				this.unTableaustatuslog.refresh(donnees);
		}
	else if (e.getSource() == this.rechercheridres)
	{

		int idreservation = Integer.parseInt(this.txtrechercheridres.getText());
			Contratlocation unContraloc = new Contratlocation(idreservation);
			Modele.selectallcontratres(unContraloc);
			Object uneLigne[]={unContraloc.getIdcontratloc(),unContraloc.getIdreservation(),unContraloc.getIdlogement(),unContraloc.getCreatedate()};
			Object donnees [][] = this.remplirDonneesrechercheContratloc(unContraloc);
			this.unTableauloc.refresh(donnees);
		}
	else if (e.getSource() == this.affichercontratlog)
	{
		Object donnees [][] = this.remplirDonneesContratlog();
		this.unTableaustatuslog.refresh(donnees);
	}
	
	else if (e.getSource() == this.affichercontratloc)
	{
		Object donnees [][] = this.remplirDonneesContratloc();
		this.unTableauloc.refresh(donnees);
	}
	}	
}