<?php
	require("fonctions_bd_gase.php");
	
	function EnregistrerNouvelleReference($designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible)
	{
		$connection = ConnectionBDD();
		
//mysql_query("LOCK TABLES _inde_REFERENCES WRITE");
//mysql_query("SET AUTOCOMMIT = 0");

$requete1 = "INSERT INTO _inde_REFERENCES (DESIGNATION, ID_FOURNISSEUR, VRAC, ID_CATEGORIE, PRIX_TTC, TVA, VISIBLE, CODE_FOURNISSEUR, COMMENTAIRE, DATE_REFERENCEMENT) values('$designation','$fournisseur','$vrac','$categorie','$prix','$tva','$visible','$codeFournisseur', '$commentaire', NOW())";		
mysql_query($requete1);

$result = mysql_query("SELECT MAX(ID_REFERENCE) FROM _inde_REFERENCES");
$resultat=mysql_fetch_row($result);

$idRefMax = $resultat[0];

$requete2 = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, ID_ACHAT, QUANTITE) values('$idRefMax',0,'CREATION',NOW(),NULL, 0)";
mysql_query($requete2);

//mysql_query("COMMIT");  
//mysql_query("UNLOCK TABLES");	
				
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeReferences()
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_REFERENCE, DESIGNATION FROM _inde_REFERENCES ORDER BY DESIGNATION");
		while ( $row = mysql_fetch_array($result))
		{
			$listeAdherents[$row["ID_REFERENCE"]] = $row["DESIGNATION"];
		}
		
		FermerConnectionBDD($connection);
		
		return $listeAdherents;
	}
	
	function SelectionDonneesReference($idReference)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT DESIGNATION, ID_FOURNISSEUR, VRAC, ID_CATEGORIE, PRIX_TTC, TVA, VISIBLE, CODE_FOURNISSEUR, COMMENTAIRE, DATE_REFERENCEMENT FROM _inde_REFERENCES WHERE ID_REFERENCE= '$idReference'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['DESIGNATION'] = $row[0];
			$donnees['ID_FOURNISSEUR'] = $row[1];
			$donnees['VRAC'] = $row[2];
			$donnees['ID_CATEGORIE'] = $row[3];
			$donnees['PRIX_TTC'] = $row[4];
			$donnees['TVA'] = $row[5];
			$donnees['VISIBLE'] = $row[6];
			$donnees['CODE_FOURNISSEUR'] = $row[7];
			$donnees['COMMENTAIRE'] = $row[8];
			$donnees['DATE_REFERENCEMENT'] = $row[9];
		}

		FermerConnectionBDD($connection);
		
		return $donnees;
	}
	
	function MajReference($idReference, $designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible)
	{
		$connection = ConnectionBDD();

		$requete = "UPDATE _inde_REFERENCES SET DESIGNATION = '$designation', ID_FOURNISSEUR='$fournisseur', VRAC='$vrac', ID_CATEGORIE='$categorie', PRIX_TTC = '$prix', TVA = '$tva', VISIBLE = '$visible', CODE_FOURNISSEUR = '$codeFournisseur', COMMENTAIRE = '$commentaire' WHERE ID_REFERENCE = '$idReference'";
		mysql_query($requete);

		FermerConnectionBDD($connection);
	}
	
	function SelectionListeReferencesMenu($idCategorie)
	{
		$connection = ConnectionBDD();

		$compteur = 0;
		
		$result = mysql_query("SELECT p.NOM, r.DESIGNATION, r.PRIX_TTC, r.ID_REFERENCE, r.VRAC FROM _inde_REFERENCES r, _inde_FOURNISSEURS p WHERE r.ID_CATEGORIE = '$idCategorie' AND p.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND r.VISIBLE = 1 ORDER BY r.DESIGNATION");
		while ( $row = mysql_fetch_array($result))
		{		
			$ligne['PRODUCTEUR'] = $row[0];
			$ligne['REFERENCE'] = $row[1];
			$ligne['PRIX'] = $row[2];
			$ligne['ID_REFERENCE'] = $row[3];
			$ligne['VRAC'] = $row[4];

			$listeRef[$compteur] = $ligne;
			$compteur++;
		}

		FermerConnectionBDD($connection);
		
		return $listeRef;
	}
		
?>
