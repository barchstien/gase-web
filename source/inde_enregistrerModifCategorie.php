<?php
require("inde_fonctionsCAT.php"); 

include 'inde_menu.php';
 
// Si le formulaire a été envoyé
if (isset ($_POST['modifierCategorie']))
{
	$idCategorie = $_POST['idCategorie'];
	
	$nom = $_POST['nom'];
	$nom = stripslashes(str_replace("'", "_", $nom));
	$nom = strtoupper($nom);
	//Le nom est obligatoire
	if(empty($nom))
	{
		print("<center>Le '<b>NOM</b>' de la categorie n est pas renseigne !</center>");
	}
	else
	{
		//On ne teste pas si une categorie sous ce nom n'est pas déjà enregistré
		$visible = $_POST['visible'];
		$nouvelleCatMere = $_POST['catMere'];

		if($nouvelleCatMere == 0)
		{
			MajCategorie($idCategorie, $nom, $visible);
			echo 'Les donnees de la categorie ' . $nom . ' ont ete mises a jour dans la base de donnees.';
		}
		else
		{
			$ancienneCatMere = SelectionIdCategorieMere($idCategorie);
			if($ancienneCatMere == $nouvelleCatMere)
			{
				MajCategorie($idCategorie, $nom, $visible);
				echo 'Les donnees de la sous-categorie ' . $nom . ' ont ete mises a jour dans la base de donnees.';
			}
			else
			{
				MajSousCategorie($idCategorie, $nom, $visible, $nouvelleCatMere, $ancienneCatMere);
				echo 'Les donnees de la sous-categorie ' . $nom . ' ont ete mises a jour dans la base de donnees.';
			}
		}
	}
}
?>