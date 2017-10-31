<?php
require("inde_fonctionsMC.php");
 
// Si le formulaire a été envoyé
if (isset ($_POST['enregistrerAppro']))
{
	$idAdherent = $_POST['idAdherent'];
	
	$versement = $_POST['versement'];
	$versement = trim($versement);
	$versement = str_replace(",", ".", $versement);
	
	if(is_numeric($versement))
	{
		// bastien 31/10/2017 : allow négative versement, useful to close accounts and fix mistakes
		ApprovisionnementMC($idAdherent, $versement);
		include ('inde_infoApproMC.php');
	}
	else
	{
		echo 'la somme indiquee n est pas une valeur numerique.';
	}
}

?>
