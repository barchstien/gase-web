<?php
	require("fonctions_bd_gase.php");
	
	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 * AC 02-05-2016 fonction globale requete()
	 */
	
	function EnregistrerNouvelleReference($designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible, $alert_stock)
	{
		
		//no alert stock (empty) => stored as -1 in db
	    //... reference wih null as alert will be set to -1 when modified
	    //... there might be an alert level set to 0
	    if ($alert_stock == ""){
	        $alert_stock = -1;
	    }
	    
        $requete1 = "INSERT INTO _inde_REFERENCES (DESIGNATION, ID_FOURNISSEUR, VRAC, ID_CATEGORIE, PRIX_TTC, TVA, VISIBLE, CODE_FOURNISSEUR, COMMENTAIRE, ALERT_STOCK, DATE_REFERENCEMENT) values('$designation','$fournisseur','$vrac','$categorie','$prix','$tva','$visible','$codeFournisseur', '$commentaire', '$alert_stock', NOW())";		
        requete($requete1);

        $result = requete("SELECT MAX(ID_REFERENCE) FROM _inde_REFERENCES");
        $resultat = $result->fetch_row();

        $idRefMax = $resultat[0];

        $requete2 = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, ID_ACHAT, QUANTITE) values('$idRefMax',0,'CREATION',NOW(),NULL, 0)";
        requete($requete2);		
		
	}
	
	function SelectionListeReferences()
	{
		$result = requete("SELECT ID_REFERENCE, DESIGNATION FROM _inde_REFERENCES ORDER BY DESIGNATION");
		while ( $row = $result->fetch())
		{
			$listeAdherents[$row["ID_REFERENCE"]] = $row["DESIGNATION"];
		}
		
		return $listeAdherents;
	}
	
	function SelectionDonneesReference($idReference)
	{

		$result = requete("SELECT r.DESIGNATION, r.ID_FOURNISSEUR, r.VRAC, r.ID_CATEGORIE, r.PRIX_TTC, r.TVA, r.VISIBLE, r.CODE_FOURNISSEUR, r.COMMENTAIRE, r.DATE_REFERENCEMENT, r.ALERT_STOCK, f.NOM 
		    FROM _inde_REFERENCES r, _inde_FOURNISSEURS f 
		    WHERE ID_REFERENCE = '$idReference'
		    AND r.ID_FOURNISSEUR = f.ID_FOURNISSEUR");
		while ( $row = $result->fetch())
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
	        //... reference with null as alert will be set to -1 when modified for the first time
	        //... there might be an alert level set to 0
	        if ($donnees['ALERT_STOCK'] == "-1"){
	            $donnees['ALERT_STOCK'] = "";
	        }
	        //exra data, usefull for some cases
	        $donnees['NOM_FOURNISSEUR'] = $row[11];
		}
		
		return $donnees;
	}
	
	function MajReference($idReference, $designation, $fournisseur, $categorie, $prix, $tva, $vrac, $codeFournisseur, $commentaire, $visible, $alert_stock)
	{
		//no alert stock (empty) => stored as -1 in db
	    //... reference wih null as alert will be set to -1 when modified
	    //... there might be an alert level set to 0
	    if ($alert_stock == ""){
	        $alert_stock = -1;
	    }
	    
		$requete = "UPDATE _inde_REFERENCES SET DESIGNATION = '$designation', ID_FOURNISSEUR='$fournisseur', VRAC='$vrac', ID_CATEGORIE='$categorie', PRIX_TTC = '$prix', ALERT_STOCK = '$alert_stock', TVA = '$tva', VISIBLE = '$visible', CODE_FOURNISSEUR = '$codeFournisseur', COMMENTAIRE = '$commentaire' WHERE ID_REFERENCE = '$idReference'";
		requete($requete);
		
	}
	
	function SelectionListeReferencesMenu($idCategorie)
	{

		$compteur = 0;
		$result = requete("SELECT p.NOM, r.DESIGNATION, r.PRIX_TTC, r.ID_REFERENCE, r.VRAC FROM _inde_REFERENCES r, _inde_FOURNISSEURS p WHERE r.ID_CATEGORIE = '$idCategorie' AND p.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND r.VISIBLE = 1 ORDER BY r.DESIGNATION");
		while ( $row = $result->fetch())
		{		
			$ligne['PRODUCTEUR'] = $row[0];
			$ligne['REFERENCE'] = $row[1];
			$ligne['PRIX'] = $row[2];
			$ligne['ID_REFERENCE'] = $row[3];
			$ligne['VRAC'] = $row[4];

			$listeRef[$compteur] = $ligne;
			$compteur++;
		}
		
		return $listeRef;
	}
		
?>
