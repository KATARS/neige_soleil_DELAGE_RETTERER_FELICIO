package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.*;
import java.io.File;
import java.io.IOException;
import java.net.URL;

import javax.imageio.ImageIO;
import javax.swing.*;

import controleur.Main;

public class VueGenerale extends JFrame implements ActionListener{
	
	private JPanel panelmenu=new JPanel();
	private JButton tabbutton[]=new JButton[4];
	private String tab[]={"Utilisateurs","Logements","Contrats","Quitter"};
	private VueUsers uneVueClients=new VueUsers();
	private VueLogements uneVueLogements=new VueLogements();
	private VueContrats uneVueContrats=new VueContrats();
	public VueGenerale(){
		this.setTitle("logiciel de gestion de Neige & Soleil");
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setLayout(null);
		this.setResizable(false);
		this.setBounds(0, 200, 1280, 720);
		ImageIcon logo = new ImageIcon("src/images/logo.png");
		JLabel lbLogo = new JLabel(logo);
		this.getContentPane().add(lbLogo);
		
		
		//construction du pannel menu
		this.panelmenu.setBounds(0, 20, 1280, 30);
		this.panelmenu.setLayout(new GridLayout(1,4));
		//construction des boutons
		for (int i=0;i<this.tabbutton.length;i++){
			this.tabbutton[i]=new JButton(this.tab[i]);
			this.panelmenu.add(this.tabbutton[i]);
			this.tabbutton[i].addActionListener(this);
		}
		
		this.getContentPane().setBackground(new Color(52,52,52));
		this.panelmenu.setVisible(true);
		this.add(this.panelmenu);
		
		this.add(this.uneVueClients);
		this.add(this.uneVueContrats);
		this.add(this.uneVueLogements);
		this.setVisible(true);
		
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		switch(e.getActionCommand()){
		case "Utilisateurs":
			this.uneVueClients.setVisible(true);
			this.uneVueLogements.setVisible(false);
			this.uneVueContrats.setVisible(false);
			break;
		case "Logements":
			this.uneVueClients.setVisible(false);
			this.uneVueLogements.setVisible(true);
			this.uneVueContrats.setVisible(false);
			break;
		case "Contrats":
			this.uneVueClients.setVisible(false);
			this.uneVueLogements.setVisible(false);
			this.uneVueContrats.setVisible(true);
			break;
		case "Quitter":
			this.dispose();
			Main.rendreVisible(true);
			break;
			
		}
		
	}

}
