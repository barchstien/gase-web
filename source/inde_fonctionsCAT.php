<?php
    require("fonctions_bd_gase.php");

	function EnregistrerNouvelleCategorie($nom)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_CATEGORIES (NOM) values('$nom')";
		mysql_query($requete);
		
		FermerConnectionBDD($connection);
	}	
	
	function EnregistrerNouvelleSousCategorie($nom, $idCatSup)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_CATEGORIES (NOM, ID_CAT_SUP) values('$nom','$idCatSup')";
		mysql_query($requete);
		
		$requete = "UPDATE _inde_CATEGORIES SET SOUS_CATEGORIES = 1 WHERE ID_CATEGORIE = '$idCatSup'";
		mysql_query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeCategoriesMeres()
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE ID_CAT_SUP is NULL ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		FermerConnectionBDD($connection);
		
		return $listeCategories;
	}
	
	function SelectionListeCategories()
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		FermerConnectionBDD($connection);
		
		return $listeCategories;
	}
	
	function SelectionDonneesCategorie($idCategorie)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT NOM, ID_CAT_SUP, SOUS_CATEGORIES, VISIBLE FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ID_CAT_SUP'] = $row[1];
			$donnees['SOUS_CATEGORIES'] = $row[2];
			$donnees['VISIBLE'] = $row[3];
		}

		FermerConnectionBDD($connection);
		
		return $donnees;
	}
	
	function SelectionNomCategorieMere($idCategorie)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT c2.NOM FROM _inde_CATEGORIES c1, _inde_CATEGORIES c2 WHERE c1.ID_CATEGORIE = '$idCategorie' AND c2.ID_CATEGORIE = c1.ID_CAT_SUP");
		
		$nom = "";
		while ( $row = mysql_fetch_array($result))
		{		
			$nom = $row['NOM'];
		}

		FermerConnectionBDD($connection);
		
		return $nom;		
	}
	
	function MajCategorie($idCategorie, $nom, $visible)
	{
		$connection = ConnectionBDD();
		$requete = "UPDATE _inde_CATEGORIES SET NOM = '$nom', VISIBLE = '$visible' WHERE ID_CATEGORIE = '$idCategorie'";
		mysql_query($requete);

		FermerConnectionBDD($connection);
	}
	
	function SelectionIdCategorieMere($idCategorie)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_CAT_SUP FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{		
			$id = $row['ID_CAT_SUP'];
		}

		FermerConnectionBDD($connection);
		
		return $id;		
	}
	
	function MajSousCategorie($idCategorie, $nom, $visible, $NouvelleCatMere, $ancienneCatMere)
	{
		$connection = ConnectionBDD();

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
		
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeCategoriesFilles()
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_CATEGORIE, NOM FROM _inde_CATEGORIES WHERE SOUS_CATEGORIES = 0 ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeCategories[$row["ID_CATEGORIE"]] = $row["NOM"];
		}
		
		FermerConnectionBDD($connection);
		
		return $listeCategories;
	}
	
	function SelectionNomCategorie($idCategorie)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT NOM FROM _inde_CATEGORIES WHERE ID_CATEGORIE = '$idCategorie'");
		while ( $row = mysql_fetch_array($result))
		{
			$nom = $row["NOM"];
		}
		
		FermerConnectionBDD($connection);
		
		return $nom;
	}
	
	function SelectionListeCategoriesMenu()
	{
		$connection = ConnectionBDD();

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
		
		FermerConnectionBDD($connection);
		
		return $listeCategories;
	}
	
	function SelectionListeSousCategories($idCategorie)
	{
		$connection = ConnectionBDD();

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
		
		FermerConnectionBDD($connection);
		
		return $listeCategories;
	}
?>
