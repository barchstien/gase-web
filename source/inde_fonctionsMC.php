<?php
	require("fonctions_bd_gase.php");
	
	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 */
	
	function SelectionSoldeAdherentMC($idAdherent)
	{
		global $mysql;
		$result = $mysql->query("SELECT SOLDE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND DATE = (SELECT MAX(DATE) FROM _inde_COMPTES WHERE ID_ADHERENT= '$idAdherent')");
		while ( $row = $result->fetch())
		{
			$solde = $row["SOLDE"];
		}		
		
		return $solde;
	}
	
	function SelectionVersementsMC($idAdherent)
	{
		global $mysql;
		$result = $mysql->query("SELECT MONTANT,DATE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'APPROVISIONNEMENT' UNION SELECT -MONTANT,DATE FROM _inde_COMPTES WHERE ID_ADHERENT='$idAdherent' AND OPERATION = 'DEPENSE' ORDER BY 2 DESC ");
		$tabVersements = [];
		while ( $row = $result->fetch())
		{
			$tabVersements[$row["DATE"]] = $row["MONTANT"];
		}
		
		return $tabVersements;
	}
	
	function ApprovisionnementMC($idAdherent, $somme)
	{
		global $mysql;
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) + $somme;
		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'APPROVISIONNEMENT','$somme')";
		$result = $mysql->query($requete);		

		
	}
	
	
	function DepenseMC($idAdherent, $somme)
	{
		$nouveauSolde = SelectionSoldeAdherentMC($idAdherent) - $somme;
		$nouveauSolde = str_replace(",", ".", $nouveauSolde);
		$somme = str_replace(",", ".", $somme);

        global $mysql;
		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherent','$nouveauSolde',NOW(),'DEPENSE','$somme')";
		$result = $mysql->query($requete);	

		
	}
	
?>
