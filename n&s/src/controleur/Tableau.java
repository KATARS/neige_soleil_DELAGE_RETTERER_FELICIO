package controleur;

import javax.swing.table.AbstractTableModel;

public class Tableau extends AbstractTableModel
{
	
	private Object [][] donnees;//matrice des donnees
	private String entete[];//entete des colonnes
	
	public Tableau (Object donnees [][], String entete []){
		this.donnees = donnees;
		this.entete = entete;
	}
	
	@Override
	public int getColumnCount() {
			
		return this.entete.length;//nombre de colonne de l'entete
	}

	@Override
	public int getRowCount() {
			
		return this.donnees.length;//nombre de ligne de la matrice
	}

	@Override
	public Object getValueAt(int rowIndex, int ColumnIndex) {
			
		return this.donnees[rowIndex][ColumnIndex];
		//retourne l'élément de la matrice d'indices rowIndex et columnIndex.
	}
	
	public void refresh(Object donnees [][])
	{
	
		//mise a jour de la matrice
		this.donnees = donnees;
		//mise a jour du graphique
		this.fireTableDataChanged();
	}
	public void add(Object ligne[])
	{
		
		Object newTable [][] = new Object [this.donnees.length + 1][this.entete.length];
		
		//recopie la matrice dans la nouvelle matrice
		for (int i = 0; i < this.donnees.length; i++)
		{
			newTable[i] = this.donnees[i];
		}
		
		//ajout de la ligne à la fin de la table
		newTable[this.donnees.length] = ligne;
		//mise a jour de la matrice
		this.donnees = newTable;
		//mise a jour du graphique
		this.fireTableDataChanged();
	}
	public String getColumnName(int columnIndex){
		return this.entete[columnIndex];
	}
	
	public void delete(int rowIndex) {
		
	}
	public void update(int rowIndex, Object ligne[]) {
		
	}
	
}
