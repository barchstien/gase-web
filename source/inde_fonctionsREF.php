<?php
	require("fonctions_bd_gase.php");
	
	function EnregistrerNouvelleReference($designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible, $alert_stock)
	{
		$connection = ConnectionBDD();
		
		//no alert stock (empty) => stored as -1 in db
	    //... reference wih null as alert will be set to -1 when modified
	    //... there might be an alert level set to 0
	    if ($alert_stock == ""){
	        $alert_stock = -1;
	    }
	    
        $requete1 = "INSERT INTO _inde_REFERENCES (DESIGNATION, ID_FOURNISSEUR, VRAC, ID_CATEGORIE, PRIX_TTC, TVA, VISIBLE, CODE_FOURNISSEUR, COMMENTAIRE, ALERT_STOCK, DATE_REFERENCEMENT) values('$designation','$fournisseur','$vrac','$categorie','$prix','$tva','$visible','$codeFournisseur', '$commentaire', '$alert_stock', NOW())";		
        $connection->query($requete1);

        $result = $connection->query("SELECT MAX(ID_REFERENCE) FROM _inde_REFERENCES");
        $resultat = $result->fetch_row();

        $idRefMax = $resultat[0];

        $requete2 = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, ID_ACHAT, QUANTITE) values('$idRefMax',0,'CREATION',NOW(),NULL, 0)";
        $connection->query($requete2);		
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeReferences()
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT ID_REFERENCE, DESIGNATION FROM _inde_REFERENCES ORDER BY DESIGNATION");
		while ( $row = $result->fetch_array())
		{
			$listeAdherents[$row["ID_REFERENCE"]] = $row["DESIGNATION"];
		}
		FermerConnectionBDD($connection);
		return $listeAdherents;
	}
	
	function SelectionDonneesReference($idReference)
	{
		$connection = ConnectionBDD();

		$result = $connection->query("SELECT DESIGNATION, ID_FOURNISSEUR, VRAC, ID_CATEGORIE, PRIX_TTC, TVA, VISIBLE, CODE_FOURNISSEUR, COMMENTAIRE, DATE_REFERENCEMENT, ALERT_STOCK FROM _inde_REFERENCES WHERE ID_REFERENCE= '$idReference'");
		while ( $row = $result->fetch_array())
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
			$donnees['ALERT_STOCK'] = $row[10];
			//no alert stock (empty) => stored as -1 in db
	        //... reference wih null as alert will be set to -1 when modified for the first time
	        //... there might be an alert level set to 0
	        if ($donnees['ALERT_STOCK'] == "-1"){
	            $donnees['ALERT_STOCK'] = "";
	        }
		}
		FermerConnectionBDD($connection);
		return $donnees;
	}
	
	function MajReference($idReference, $designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible, $alert_stock)
	{
		$connection = ConnectionBDD();
		//no alert stock (empty) => stored as -1 in db
	    //... reference wih null as alert will be set to -1 when modified
	    //... there might be an alert level set to 0
	    if ($alert_stock == ""){
	        $alert_stock = -1;
	    }
	    
		$requete = "UPDATE _inde_REFERENCES SET DESIGNATION = '$designation', ID_FOURNISSEUR='$fournisseur', VRAC='$vrac', ID_CATEGORIE='$categorie', PRIX_TTC = '$prix', ALERT_STOCK = '$alert_stock', TVA = '$tva', VISIBLE = '$visible', CODE_FOURNISSEUR = '$codeFournisseur', COMMENTAIRE = '$commentaire' WHERE ID_REFERENCE = '$idReference'";
		error_log($requete);
		$connection->query($requete);
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeReferencesMenu($idCategorie)
	{
		$connection = ConnectionBDD();

		$compteur = 0;
		$result = $connection->query("SELECT p.NOM, r.DESIGNATION, r.PRIX_TTC, r.ID_REFERENCE, r.VRAC FROM _inde_REFERENCES r, _inde_FOURNISSEURS p WHERE r.ID_CATEGORIE = '$idCategorie' AND p.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND r.VISIBLE = 1 ORDER BY r.DESIGNATION");
		while ( $row = $result->fetch_array())
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
