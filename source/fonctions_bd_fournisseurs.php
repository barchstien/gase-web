<?php
require("fonctions_bd_gase.php");

function SelectionListeFournisseurs()
{
	$connection = ConnectionBDD();

	$result = mysql_query("SELECT ID_FOURNISSEUR, NOM FROM _inde_FOURNISSEURS ORDER BY NOM");
	while ( $row = mysql_fetch_array($result))
	{
		$listeAdherents[$row["ID_FOURNISSEUR"]] = $row[NOM];
	}
	
	FermerConnectionBDD($connection);
	
	return $listeAdherents;
}

function EnregistrerNouveauFournisseur($nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible)
{
	$connection = ConnectionBDD();

	$requete = "INSERT INTO _inde_FOURNISSEURS (NOM, MAIL, ADRESSE, CONTACT, TELEPHONE_FIXE, TELEPHONE_PORTABLE, FAX, COMMENTAIRE, DATE_REFERENCEMENT, VISIBLE) values('$nom','$mail','$adresse','$contact','$telephoneFixe','$telephonePortable', '$fax', '$commentaire', NOW(),'$visible')";
	mysql_query($requete);
	
	FermerConnectionBDD($connection);
}

function SelectionDonneesFournisseur($idFournisseur)
{
	$connection = ConnectionBDD();

	$result = mysql_query("SELECT NOM, MAIL, CONTACT, ADRESSE, TELEPHONE_FIXE, TELEPHONE_PORTABLE, FAX, COMMENTAIRE, VISIBLE, DATE_REFERENCEMENT FROM _inde_FOURNISSEURS WHERE ID_FOURNISSEUR= '$idFournisseur'");
	while ( $row = mysql_fetch_array($result))
	{		
		$donnees['NOM'] = $row[0];
		$donnees['MAIL'] = $row[1];
		$donnees['CONTACT'] = $row[2];
		$donnees['ADRESSE'] = $row[3];
		$donnees['TELEPHONE_FIXE'] = $row[4];
		$donnees['TELEPHONE_PORTABLE'] = $row[5];
		$donnees['FAX'] = $row[6];
		$donnees['COMMENTAIRE'] = $row[7];
		$donnees['VISIBLE'] = $row[8];
		$donnees['DATE_REFERENCEMENT'] = $row[9];
	}

	FermerConnectionBDD($connection);
	
	return $donnees;
}

function MajFournisseur($idFournisseur, $nom, $mail, $adresse, $contact, $telephoneFixe, $telephonePortable, $fax, $commentaire, $visible)
{
	$connection = ConnectionBDD();

	$requete = "UPDATE _inde_FOURNISSEURS SET NOM = '$nom', MAIL='$mail', CONTACT='$contact', ADRESSE = '$adresse', TELEPHONE_FIXE = '$telephoneFixe', TELEPHONE_PORTABLE = '$telephonePortable', FAX = '$fax', COMMENTAIRE = '$commentaire', VISIBLE = '$visible' WHERE ID_FOURNISSEUR = '$idFournisseur'";
	mysql_query($requete);

	FermerConnectionBDD($connection);
}

function SelectionListeVisiblesFR()
{
	$connection = ConnectionBDD();

	$result = mysql_query("SELECT ID_FOURNISSEUR, NOM FROM _inde_FOURNISSEURS WHERE VISIBLE = 1 ORDER BY NOM");
	while ( $row = mysql_fetch_array($result))
	{
		$listeAdherents[$row[ID_FOURNISSEUR]] = $row[NOM];
	}
	
	FermerConnectionBDD($connection);
	
	return $listeAdherents;
}

function SelectionNomFournisseur($idFournisseur)
{
	$connection = ConnectionBDD();

	$result = mysql_query("SELECT NOM FROM _inde_FOURNISSEURS WHERE ID_FOURNISSEUR = '$idFournisseur'");
	while ( $row = mysql_fetch_array($result))
	{
		$nom = $row[NOM];
	}
	
	FermerConnectionBDD($connection);
	
	return $nom;
}
	
?>

?>
