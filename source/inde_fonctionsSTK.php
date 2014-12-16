<?php
	require("fonctions_bd_gase.php");
	
	function SelectionListeSTK()
	{
		$connection = ConnectionBDD();
		$compteur = 0;
		
		$result = $connection->query(
		    "SELECT s1.STOCK, r.DESIGNATION, f.NOM, c.NOM, r.ID_REFERENCE 
		    FROM _inde_STOCKS s1, _inde_REFERENCES r, _inde_FOURNISSEURS f, _inde_CATEGORIES c 
		    WHERE s1.DATE = (SELECT MAX(s2.DATE) FROM _inde_STOCKS s2 WHERE s2.ID_REFERENCE=s1.ID_REFERENCE) 
		    AND r.ID_REFERENCE = s1.ID_REFERENCE 
		    AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR 
		    AND c.ID_CATEGORIE = r.ID_CATEGORIE 
		    ORDER BY c.NOM, r.DESIGNATION");
		while ( $row = $result->fetch_array())
		{		
			$donnees['STOCK'] = $row[0];
			$donnees['DESIGNATION'] = $row[1];
			$donnees['NOM'] = $row[2];
			$donnees['CATEGORIE'] = $row[3];
			$donnees['ID_REFERENCE'] = $row[4];
			
			$listeStocks[$compteur] = $donnees;
			$compteur++;
		}
		FermerConnectionBDD($connection);
		return $listeStocks;
	}
	
	function SelectionStocks($idFournisseur)
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT r.CODE_FOURNISSEUR, r.ID_REFERENCE, r.DESIGNATION, c.NOM FROM _inde_REFERENCES r, _inde_FOURNISSEURS f, _inde_CATEGORIES c WHERE f.ID_FOURNISSEUR = '$idFournisseur' AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR AND c.ID_CATEGORIE = r.ID_CATEGORIE ORDER BY c.NOM, r.DESIGNATION");
		
		$compteur = 0;
		$listeStocks = array();
		while ( $row = $result->fetch_array())
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
		FermerConnectionBDD($connection);
		return $listeStocks;
	}
		
	function SelectionStockRefSTK($idReference)
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT STOCK FROM _inde_STOCKS WHERE ID_REFERENCE='$idReference' AND DATE = (SELECT MAX(DATE) FROM _inde_STOCKS WHERE ID_REFERENCE='$idReference')");
		$row = $result->fetch_array();
		$stock = $row["STOCK"];
		
		FermerConnectionBDD($connection);
		return $stock;
	}

	function ModifierSTK($idReference, $quantite)
	{
		$nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);
		
		$connection = ConnectionBDD();
		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','APPROVISIONNEMENT', NOW(), '$quantite', NULL)";
		$connection->query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function AchatSTK($idAchat, $idReference, $quantite)
	{
		$nouveauStock = SelectionStockRefSTK($idReference) - $quantite;

		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);

        $connection = ConnectionBDD();
		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','ACHAT', NOW(), '$quantite', '$idAchat')";
		$connection->query($requete);
		FermerConnectionBDD($connection);
	}
	
	function ModifierInventaireSTK($idReference, $quantite)
	{
		$nouveauStock = SelectionStockRefSTK($idReference) + $quantite;
	
		$nouveauStock = str_replace(",", ".", $nouveauStock);
		$quantite = str_replace(",", ".", $quantite);

        $connection = ConnectionBDD();
		$requete = "INSERT INTO _inde_STOCKS (ID_REFERENCE, STOCK, OPERATION, DATE, QUANTITE, ID_ACHAT) values('$idReference','$nouveauStock','INVENTAIRE', NOW(), '$quantite', NULL)";
		$connection->query($requete);	
		
		FermerConnectionBDD($connection);
	}
	
	/** get list of references with alert on stock raised
	meaning those that are visible, that have a stock alert, and where stock alert is reached */
	function getReferencesWithStockAlertRaised(){
	    $connection = ConnectionBDD();
	    $connection->query("SELECT");
	    
		//rows with ALERT_STOCK == NULL are ignored by r.ALERT_STOCK != -1 ...
		//... rows with field NULL, can be selected with r.ALERT_STOCK IS NULL (or IS NOT NULL)
		//... != -1 important, in case stock error get stock to below -1
		$result = $connection->query(
		    "SELECT s1.STOCK, r.DESIGNATION, f.NOM, c.NOM, r.ID_REFERENCE, r.ALERT_STOCK 
		    FROM _inde_STOCKS s1, _inde_REFERENCES r, _inde_FOURNISSEURS f, _inde_CATEGORIES c 
		    WHERE s1.DATE = 
		        (SELECT MAX(s2.DATE) FROM _inde_STOCKS s2 WHERE s2.ID_REFERENCE=s1.ID_REFERENCE) 
		    AND r.ID_REFERENCE = s1.ID_REFERENCE 
		    AND f.ID_FOURNISSEUR = r.ID_FOURNISSEUR 
		    AND c.ID_CATEGORIE = r.ID_CATEGORIE 
		    AND r.ALERT_STOCK != -1 
		    AND r.ALERT_STOCK >= s1.STOCK
		    ORDER BY c.NOM, r.DESIGNATION");
		$listeStocks = null;
		while ( $row = $result->fetch_array())
		{		
			$donnees['STOCK'] = $row[0];
			$donnees['DESIGNATION'] = $row[1];
			$donnees['NOM'] = $row[2];
			$donnees['CATEGORIE'] = $row[3];
			$donnees['ID_REFERENCE'] = $row[4];
			$donnees['ALERT_STOCK'] = $row[5];
			
			$listeStocks[] = $donnees;
		}
		FermerConnectionBDD($connection);
		return $listeStocks;
	}
	
?>
