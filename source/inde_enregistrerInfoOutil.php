<?php
//to remove
//require("inde_fonctionsOutil.php");
require("fonctions_bd_gase.php");
 
// Si le formulaire a été envoyé
if (isset ($_POST['enregistrerInfoOutil']))
{
	$info = $_POST['info'];
	$info = str_replace("'", "_", $info);

	EnregistrerInfoOutil($info);

    header('location:inde_1infoOutil.php');
}


?>
