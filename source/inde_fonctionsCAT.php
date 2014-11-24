<?php
	function ConnexionBDD_CAT()
	{
		if(!$connexion)
		{	
			$connection = mysql_connect("localhost", "gase", "gasepass") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
		}	
	}
	
	function FermerConnexionBDD_CAT($connexion)
	{
		mysql_close($connection);
	}

	function EnregistrerNouvelleCategorie($nom)
	{
		$connexion = ConnexionBDD_CAT();

		$requete = "INSERT INTO _inde_CATEGORIES (NOM) values('$nom')";
		mysql_query($requete);
		
		FermerConnexionBDD_CAT($connexion);
	}	
	
	function EnregistrerNouvelleSousCategorie($nom, $idCatSup)
	{
		$connexion = ConnexionBDD_CAT();

		$requete = "INSERT INTO _inde_CATEGORIES (NOM, ID_CAT_SUP) values('$nom','$idCatSup')";
		mysql_query($requete);
		
		$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = 1 WHERE ID_CATEGORIE = '$idCatSup'";
		mysql_query($requete);
		
		FermerConnexionBDD_CAT($connexion);
	}
	
	function SelectionListeCategoriesMeres()
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE ID_CAT_SUP is NULL ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row[ID_CATEGORIE]] = $row[NOM];
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $listeCategories;
	}
	
	function SelectionListeCategories()
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row[ID_CATEGORIE]] = $row[NOM];
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $listeCategories;
	}
	
	function SelectionDonneesCategorie($idCategorie)
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT NOM, ID_CAT_SUP, SOUS_CATEGORIES, VISIBLE FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ID_CAT_SUP'] = $row[1];
			$donnees['SOUS_CATEGORIES'] = $row[2];
			$donnees['VISIBLE'] = $row[3];
		}

		FermerConnexionBDD_CAT($connexion);
		
		return $donnees;
	}
	
	function SelectionNomCategorieMere($idCategorie)
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT c2.NOM FROM _inde_CATEGORIES c1, _inde_CATEGORIES c2 WHERE c1.ID_CATEGORIE = '$idCategorie' AND c2.ID_CATEGORIE = c1.ID_CAT_SUP");
		while ( $row = mysql_fetch_array($result))
		{		
			$nom = $row['NOM'];
		}

		FermerConnexionBDD_CAT($connexion);
		
		return $nom;		
	}
	
	function MajCategorie($idCategorie, $nom, $visible)
	{
		$connexion = ConnexionBDD_CAT();
		$requete = "UPDATE _inde_CATEGORIES SET NOM = '$nom', VISIBLE = '$visible' WHERE ID_CATEGORIE = '$idCategorie'";
		mysql_query($requete);

		FermerConnexionBDD_CAT($connexion);
	}
	
	function SelectionIdCategorieMere($idCategorie)
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT ID_CAT_SUP FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{		
			$id = $row['ID_CAT_SUP'];
		}

		FermerConnexionBDD_CAT($connexion);
		
		return $id;		
	}
	
	function MajSousCategorie($idCategorie, $nom, $visible, $NouvelleCatMere, $ancienneCatMere)
	{
		$connexion = ConnexionBDD_CAT();

		$requete = "UPDATE _inde_CATEGORIES SET NOM = '$nom', VISIBLE = '$visible', ID_CAT_SUP = '$NouvelleCatMere' WHERE ID_CATEGORIE = '$idCategorie'";
		mysql_query($requete);
		
		$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = '1' WHERE ID_CATEGORIE = '$NouvelleCatMere'";
		mysql_query($requete);

		$result = mysql_query("SELECT COUNT(*) FROM _inde_CATEGORIES c WHERE c.ID_CAT_SUP = '$ancienneCatMere'");
		while ( $row = mysql_fetch_array($result))
		{		
			$nbre = $row[0];
		}
		
		if($nbre == 0)
		{
			$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = '0' WHERE ID_CATEGORIE = '$ancienneCatMere'";
			mysql_query($requete);
		}
		
		FermerConnexionBDD_CAT($connexion);
	}
	
	function SelectionListeCategoriesFilles()
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE SOUS_CATEGORIES = 0 ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row[ID_CATEGORIE]] = $row[NOM];
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $listeCategories;
	}
	
	function SelectionNomCategorie($idCategorie)
	{
		$connexion = ConnexionBDD_CAT();

		$result = mysql_query("SELECT NOM FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{
			$nom = $row[NOM];
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $nom;
	}
	
	function SelectionListeCategoriesMenu()
	{
		$connexion = ConnexionBDD_CAT();

		$compteur = 0;
		$visible = 1;
		
		$result = mysql_query("SELECT ID_CATEGORIE, NOM, ID_CAT_SUP, SOUS_CATEGORIES FROM _inde_CATEGORIES WHERE VISIBLE = '$visible' ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{		
			$ligne['ID_CATEGORIE'] = $row[0];
			$ligne['NOM'] = $row[1];
			$ligne['ID_CAT_SUP'] = $row[2];
			$ligne['SOUS_CATEGORIES'] = $row[3];
			
			$listeCategories[$compteur] = $ligne;
			$compteur++;
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $listeCategories;
	}
	
	function SelectionListeSousCategories($idCategorie)
	{
		$connexion = ConnexionBDD_CAT();

		$compteur = 0;
		$visible = 1;
		
		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE ID_CAT_SUP = '$idCategorie' AND VISIBLE = '$visible' ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{		
			$ligne['ID_CATEGORIE'] = $row[0];
			$ligne['NOM'] = $row[1];
			
			$listeCategories[$compteur] = $ligne;
			$compteur++;
		}
		
		FermerConnexionBDD_CAT($connexion);
		
		return $listeCategories;
	}
?>
