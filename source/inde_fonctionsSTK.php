<?php
	function ConnexionBDD_STK()
	{
		if(!$connexion)
		{	
			$connection = mysql_connect("localhost", "gase", "gasepass") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
		}	
	}
	
	function FermerConnexionBDD_STK($connexion)
	{
		mysql_close($connection);
	}
	
	function SelectionListeSTK()
	{
		$connexion = ConnexionBDD_STK();

		$compteur = 0;
		
		$result = mysql_query("SELECT s1.STOCK, r.DESIGNATION, f.NOM, c.NOM, r.ID_REFERENCE FROM _inde_STOCKS s1, _inde_REFERENCES r, _inde_FOURNISSEURS f, _inde_CATEGORIES c WHERE s1.DATE = (SELECT MAX(s2.DATE) FROM _inde_STOCKS s2 WHERE s2.ID_REFERENCE=s1.ID_REFERENCE) AND r.ID_REFERENCE = s1.ID_REFERENCE AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND c.ID_CATEGORIE = r.ID_CATEGORIE ORDER BY c.NOM, r.DESIGNATION");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['STOCK'] = $row[0];
			$donnees['DESIGNATION'] = $row[1];
			$donnees['NOM'] = $row[2];
			$donnees['CATEGORIE'] = $row[3];
			$donnees['ID_REFERENCE'] = $row[4];
			
			$listeStocks[$compteur] = $donnees;
			$compteur++;
		}
				
		FermerConnexionBDD_STK($connexion);
		
		return $listeStocks;
	}
	
	function SelectionStocks($idFournisseur)
	{
		$connexion = ConnexionBDD_STK();

		$compteur = 0;
		
		$result = mysql_query("SELECT r.CODE_FOURNISSEUR, r.ID_REFERENCE, r.DESIGNATION, c.NOM FROM _inde_REFERENCES r, _inde_FOURNISSEURS f, _inde_CATEGORIES c WHERE f.ID_FOURNISSEUR = '$idFournisseur' AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND c.ID_CATEGORIE = r.ID_CATEGORIE ORDER BY c.NOM, r.DESIGNATION");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['CODE_FOURNISSEUR'] = $row[0];
			$donnees['ID_REFERENCE'] = $row[1];
			$donnees['DESIGNATION'] = $row[2];
			$stock = SelectionStockRefSTK($donnees['ID_REFERENCE']);
			$donnees['STOCK'] = $stock;
			$donnees['CATEGORIE'] = $row[3];
			
			$listeStocks[$compteur] = $donnees;
			$compteur++;
		}
				
		FermerConnexionBDD_STK($connexion);
		
		return $listeStocks;
	}
		
	function SelectionStockRefSTK($idReference)
	{
		$connexion = ConnexionBDD_STK();

		$result = mysql_query("SELECT STOCK FROM _inde_STOCKS WHERE ID_REFERENCE='$idReference' AND DATE = (SELECT MAX(DATE) FROM _inde_STOCKS WHERE ID_REFERENCE='$idReference')");
		$row = mysql_fetch_array($result);
		$stock = $row[STOCK];
		
		FermerConnexionBDD_STK($connexion);
		
		return $stock;
	}

	function ModifierSTK($idReference, $quantite)
	{
		$connexion = ConnexionBDD_STK();
		$nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
	
		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);

		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','APPROVISIONNEMENT', NOW(), '$quantite', NULL)";
		mysql_query($requete);		
		
		FermerConnexionBDD_STK($connexion);
	}
	
	function AchatSTK($idAchat, $idReference, $quantite)
	{
		$connexion = ConnexionBDD_STK();
		
		$nouveauStock = SelectionStockRefSTK($idReference) - $quantite;

		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);

		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','ACHAT', NOW(), '$quantite', '$idAchat')";
		mysql_query($requete);		
		
		FermerConnexionBDD_STK($connexion);
	}
	
	function ModifierInventaireSTK($idReference, $quantite)
	{
		$connexion = ConnexionBDD_STK();
		$nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
	
		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);

		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','INVENTAIRE', NOW(), '$quantite', NULL)";
		mysql_query($requete);		
		
		FermerConnexionBDD_STK($connexion);
	}
	
?>
