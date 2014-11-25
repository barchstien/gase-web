<?php
	require("fonctions_bd_gase.php");
	
	function SelectionSoldeAdherentMC($idAdherent)
	{
		$connection = ConnectionBDD();
		$result = mysql_query("SELECT SOLDE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND DATE = (SELECT MAX(DATE) FROM _inde_COMPTES WHERE ID_ADHERENT= '$idAdherent')");
		while ( $row = mysql_fetch_array($result))
		{
			$solde = $row["SOLDE"];
		}		
		
		FermerConnectionBDD($connection);
		
		return $solde;
	}
	
	function SelectionVersementsMC($idAdherent)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT MONTANT,DATE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'APPROVISIONNEMENT' UNION SELECT -MONTANT,DATE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'DEPENSE' ORDER BY 2 DESC ");

		while ( $row = mysql_fetch_array($result))
		{
			$tabVersements[$row["DATE"]] = $row["MONTANT"];
		}
		
		FermerConnectionBDD($connection);
		
		return $tabVersements;
	}
	
	function ApprovisionnementMC($idAdherent, $somme)
	{
		$connection = ConnectionBDD();
		
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) + $somme;

		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'APPROVISIONNEMENT','$somme')";
		$result = mysql_query($requete);		

		FermerConnectionBDD($connection);
	}
	
	
	function DepenseMC($idAdherent, $somme)
	{
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) - $somme;

		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

        $connection = ConnectionBDD();
        
		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'DEPENSE','$somme')";
		$result = mysql_query($requete);	

		FermerConnectionBDD($connection);
	}
	
?>
