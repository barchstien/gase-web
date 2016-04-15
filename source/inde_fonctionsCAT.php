<?php
    require("fonctions_bd_gase.php");

	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 */	
    
    function EnregistrerNouvelleCategorie($nom)
	{
		global $mysql;
		$requete = "INSERT INTO _inde_CATEGORIES (NOM) values('$nom')";
		$mysql->query($requete);
		
	}	
	
	function EnregistrerNouvelleSousCategorie($nom, $idCatSup)
	{
		global $mysql;
		$requete = "INSERT INTO _inde_CATEGORIES (NOM, ID_CAT_SUP) values('$nom','$idCatSup')";
		$mysql->query($requete);
		$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = 1 WHERE ID_CATEGORIE = '$idCatSup'";
		$mysql->query($requete);
		
	}
	
	function SelectionListeCategoriesMeres()
	{
		global $mysql;
		$result = $mysql->query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE ID_CAT_SUP is NULL ORDER BY NOM");
		while ( $row = $result->fetch())
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		return $listeCategories;
	}
	
	function SelectionListeCategories()
	{
		global $mysql;
		$result = $mysql->query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES ORDER BY NOM");
		while ( $row = $result->fetch())
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		return $listeCategories;
	}
	
	function SelectionDonneesCategorie($idCategorie)
	{
		global $mysql;
		$result = $mysql->query("SELECT NOM, ID_CAT_SUP, SOUS_CATEGORIES, VISIBLE FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = $result->fetch())
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ID_CAT_SUP'] = $row[1];
			$donnees['SOUS_CATEGORIES'] = $row[2];
			$donnees['VISIBLE'] = $row[3];
		}
		
		return $donnees;
	}
	
	function SelectionNomCategorieMere($idCategorie)
	{
		global $mysql;
		$result = $mysql->query("SELECT c2.NOM FROM _inde_CATEGORIES c1, _inde_CATEGORIES c2 WHERE c1.ID_CATEGORIE = '$idCategorie' AND c2.ID_CATEGORIE = c1.ID_CAT_SUP");
		
		$nom = "";
		while ( $row = $result->fetch())
		{		
			$nom = $row['NOM'];
		}
		
		return $nom;		
	}
	
	function MajCategorie($idCategorie, $nom, $visible)
	{
		global $mysql;
		$requete = "UPDATE _inde_CATEGORIES SET NOM = '$nom', VISIBLE = '$visible' WHERE ID_CATEGORIE = '$idCategorie'";
		$mysql->query($requete);
		
	}
	
	function SelectionIdCategorieMere($idCategorie)
	{
		global $mysql;
		$result = $mysql->query("SELECT ID_CAT_SUP FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = $result->fetch())
		{		
			$id = $row['ID_CAT_SUP'];
		}
		
		return $id;		
	}
	
	function MajSousCategorie($idCategorie, $nom, $visible, $NouvelleCatMere, $ancienneCatMere)
	{
		global $mysql;
		$requete = "UPDATE _inde_CATEGORIES SET NOM = '$nom', VISIBLE = '$visible', ID_CAT_SUP = '$NouvelleCatMere' WHERE ID_CATEGORIE = '$idCategorie'";
		$mysql->query($requete);
		
		$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = '1' WHERE ID_CATEGORIE = '$NouvelleCatMere'";
		$mysql->query($requete);

		$result = $mysql->query("SELECT COUNT(*) FROM _inde_CATEGORIES c WHERE c.ID_CAT_SUP = '$ancienneCatMere'");
		while ( $row = $result->fetch())
		{		
			$nbre = $row[0];
		}
		
		if($nbre == 0)
		{
			$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = '0' WHERE ID_CATEGORIE = '$ancienneCatMere'";
			$mysql->query($requete);
		}
		
	}
	
	function SelectionListeCategoriesFilles()
	{
		global $mysql;
		$result = $mysql->query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE SOUS_CATEGORIES = 0 ORDER BY NOM");
		while ( $row = $result->fetch())
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		return $listeCategories;
	}
	
	function SelectionNomCategorie($idCategorie)
	{
		global $mysql;
		$result = $mysql->query("SELECT NOM FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = $result->fetch())
		{
			$nom = $row["NOM"];
		}
		
		return $nom;
	}
	
	function SelectionListeCategoriesMenu()
	{
		global $mysql;

		$compteur = 0;
		$visible = 1;
		$result = $mysql->query("SELECT ID_CATEGORIE, NOM, ID_CAT_SUP, SOUS_CATEGORIES FROM _inde_CATEGORIES WHERE VISIBLE = '$visible' ORDER BY NOM");
		while ( $row = $result->fetch())
		{		
			$ligne['ID_CATEGORIE'] = $row[0];
			$ligne['NOM'] = $row[1];
			$ligne['ID_CAT_SUP'] = $row[2];
			$ligne['SOUS_CATEGORIES'] = $row[3];
			
			$listeCategories[$compteur] = $ligne;
			$compteur++;
		}
		
		return $listeCategories;
	}
	
	function SelectionListeSousCategories($idCategorie)
	{
		global $mysql;

		$compteur = 0;
		$visible = 1;
		$result = $mysql->query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE ID_CAT_SUP = '$idCategorie' AND VISIBLE = '$visible' ORDER BY NOM");
		while ( $row = $result->fetch())
		{		
			$ligne['ID_CATEGORIE'] = $row[0];
			$ligne['NOM'] = $row[1];
			
			$listeCategories[$compteur] = $ligne;
			$compteur++;
		}
		
		return $listeCategories;
	}
?>
