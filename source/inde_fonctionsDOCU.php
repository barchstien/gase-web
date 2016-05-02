<?php
	require("fonctions_bd_gase.php");

	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 * AC 02-05-2016 fonction globale requete()
	 */
	
/*** DOCUMENTS ***/	
	function SelectionListeTypesDoc()
	{
		$result = requete("SELECT ID_TYPE, NOM FROM _inde_TYPE_DOC ORDER BY NOM");
		while ( $row = $result->fetch())
		{
			$listeTypesDoc[$row[ID_TYPE]] = $row[NOM];
		}
		
		return $listeTypesDoc;
	}

	function SelectionNomTypeDoc($idType)
	{
		$result = requete("SELECT NOM FROM _inde_TYPE_DOC WHERE ID_TYPE = '$idType'");
		while ( $row = $result->fetch())
		{		
			$nomType = $row[0];
		}
		
		return $nomType;
	}

	function SelectionIdDocument()
	{
		$result = requete("SELECT MAX(ID_DOCUMENT) FROM _inde_DOCUMENTS");
		while ( $row = $result->fetch())
		{		
			$idDocument = $row[0];
		}
		
		return $idDocument;
	}
	
	function EnregistrerNouvelleFacture($idType, $nom, $idFournisseur, $date, $net)
	{

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		requete($requete);
		
		
	}
	
	function EnregistrerNouveauBonCde($idType, $nom, $idFournisseur, $date, $net)
	{

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		requete($requete);
		
		
	}
	
	function EnregistrerNouveauDocInterne($idType, $nom, $date)
	{
		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType',NULL,'$date', NULL)";
		requete($requete);
		
	}
	

	function SelectionListeDocuments($idType)
	{
		$compteur = 0;
		$listeDoc = array();
		$result = requete("SELECT ID_DOCUMENT, NOM, DATE, ID_FOURNISSEUR, NET_A_PAYER FROM _inde_DOCUMENTS WHERE ID_TYPE = '$idType' ORDER BY ID_DOCUMENT");
		while ( $row = $result->fetch())
		{		
			$donnees['ID_DOCUMENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['DATE'] = $row[2];
			$donnees['ID_FOURNISSEUR'] = $row[3];
			$donnees['NET_A_PAYER'] = $row[4];
			
			$listeDoc[$compteur] = $donnees;
			$compteur++;
		}
		
		return $listeDoc;
	}	
	
	
?>
