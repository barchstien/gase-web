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
		if($versement > 0)
		{
			ApprovisionnementMC($idAdherent, $versement);
			include ('inde_infoApproMC.php');	
		}
		else
		{
			echo 'la somme indiquee n est pas une valeur positive.';
		}
	}
	else
	{
		echo 'la somme indiquee n est pas une valeur numerique.';
	}
}

?>
