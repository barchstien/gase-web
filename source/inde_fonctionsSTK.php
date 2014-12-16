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
	
	/** @return a list of year within which a purchase occured for $ref
	for example array(2013, 2014) */
	function getYearWithPurchase_forReferenceId($ref){
	    $connection = ConnectionBDD();
	    $result = $connection->query("SELECT DISTINCT YEAR(DATE) FROM _inde_STOCKS WHERE ID_REFERENCE = '$ref'");
	    $ret = array();
	    while ( $row = $result->fetch_array()){
	        if (0 != $row[0]){
	            $ret[] = $row[0];
	        }
	    }
	    FermerConnectionBDD($connection);
	    return $ret;
	}
	
	////////// Inventaire : Ecarts ////////
	function get_inventaires_dates(){
	    $connection = ConnectionBDD();
	    $result = $connection->query("SELECT distinct DATE_FORMAT(DATE,'%Y-%m-%e')
                                FROM _inde_STOCKS
                                WHERE OPERATION = 'INVENTAIRE'
                                group by DATE_FORMAT(DATE,'%Y-%m-%e')
                                ORDER BY DATE DESC;");
	    $ret = array();
	    while ( $row = $result->fetch_array()){
	        if (0 != $row[0]){
	            $ret[] = $row[0];
	        }
	    }
	    FermerConnectionBDD($connection);
	    return $ret;
	}
	
	function get_ecarts_list_for_date($date){
	    $connection = ConnectionBDD();
	    $result = $connection->query("SELECT s.QUANTITE, c.NOM, r.DESIGNATION, f.NOM, r.PRIX_TTC, s.DATE
                                FROM _inde_STOCKS s, _inde_REFERENCES r, _inde_CATEGORIES c, _inde_FOURNISSEURS f
                                WHERE s.OPERATION = 'INVENTAIRE'
                                AND DATE_FORMAT(s.DATE,'%Y-%m-%e') = '$date'
                                AND s.ID_REFERENCE = r.ID_REFERENCE
                                AND r.ID_CATEGORIE = c.ID_CATEGORIE
                                AND r.ID_FOURNISSEUR = f.ID_FOURNISSEUR;");
	    $ret = array();
	    while ( $row = $result->fetch_array()){
            $a = array();
            $a["ecart"] = $row[0];
            $a["categorie_nom"] = $row[1];
            $a["ref_designation"] = $row[2];
            $a["fournisseur_nom"] = $row[3];
            $a["ref_prix"] = $row[4];
            $ret[] = $a;
	    }
	    FermerConnectionBDD($connection);
	    return $ret;
	}
	
	
?>
