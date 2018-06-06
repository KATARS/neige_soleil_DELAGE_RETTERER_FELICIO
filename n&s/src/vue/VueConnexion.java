package vue;

import java.awt.Color;
import java.awt.GridLayout;
import java.awt.event.*;
import java.net.URL;

import javax.swing.*;
import controleur.Main;
import modele.Modele;
import modele.Modele;
import vue.VueGenerale;
public class VueConnexion extends JFrame implements ActionListener,KeyListener {
	
	private JPanel unPanel= new JPanel();
	private JButton btAnnuler=new JButton("Annuler");
	private JButton btSeConnecter=new JButton("Se Connecter");
	private JTextField txtLogin=new JTextField();
	private JPasswordField txtMdp=new JPasswordField();
	
	public VueConnexion()
	{
		this.setTitle("NEIGE&SOLEIL ADMINISTRATION");
		this.setResizable(false);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		this.setLayout(null);
		this.setBounds(200, 200, 600, 450);
		this.getContentPane().setBackground(Color.DARK_GRAY);

		

		
		
		// construction du panel
		this.unPanel.setBounds(0, 245, 600, 180);
		this.unPanel.setBackground(Color.GRAY);
		this.unPanel.setLayout(new GridLayout(3, 2));  // 3 lignes 2 colonnes
		this.unPanel.add(new JLabel("Login : "));
		this.unPanel.add(txtLogin);
		this.unPanel.add(new JLabel("MDP : "));
		this.unPanel.add(txtMdp);
		this.unPanel.add(btAnnuler);
		this.unPanel.add(btSeConnecter);
		
		// ajouter le panel dans la fenetre
		this.add(this.unPanel);
		
		// ajout de l'image dans la fenetre
        URL url = Main.class.getResource("/images/logo.png");
        ImageIcon icon = new ImageIcon(url);
		JLabel lbLogo = new JLabel(icon);
		lbLogo.setBounds(0, -80, 600, 400);
		this.add(lbLogo);
		
		// RENDRE LES BOUTONS clickables
		this.btAnnuler.addActionListener(this);
		this.btSeConnecter.addActionListener(this);
		this.txtLogin.addKeyListener(this);
		this.txtMdp.addKeyListener(this);
		
		this.setVisible(true);
		JOptionPane.showMessageDialog(this, "IDENTIFIANTS ADMIN"
				+ "\nemail : joe@test.fr"
				+ "\npassword : azerty");
	}
	@Override
	public void actionPerformed(ActionEvent e) {
		if(e.getSource() == this.btAnnuler)
		{
			this.txtLogin.setText("");
			this.txtMdp.setText("");
		}
		else if(e.getSource()==this.btSeConnecter)
		{
			traitement();
		}
	}
	public void traitement()
	{
		String login = this.txtLogin.getText();
		String mdp = new String (this.txtMdp.getPassword());
		System.out.println(mdp);
		System.out.println(login);
		//verification des identifiants dans la bdd.
		String droits = Modele.verifConnexion(login, mdp);
		if(droits.equals(""))
		{
			JOptionPane.showMessageDialog(this, "Veuillez verifier vos identifiants");
		}
		else
		{
			JOptionPane.showMessageDialog(this, "bienvenue !\n vos droits sont "+droits);
			
			// demarrage du logiciel
			new VueGenerale();
			Main.rendreVisible(false);
		}

	}
	@Override
	public void keyPressed(KeyEvent e) {
		if(e.getKeyChar() == KeyEvent.VK_ENTER)
		{
			traitement();
		}
		
	}
	@Override
	public void keyReleased(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void keyTyped(KeyEvent e) {
		// TODO Auto-generated method stub
		
	}

}