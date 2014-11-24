<?php
require("inde_fonctionsOutil.php");
 
// Si le formulaire a été envoyé
if (isset ($_POST['enregistrerInfoOutil']))
{
	$info = $_POST['info'];
	$info = str_replace("'", "_", $info);

	EnregistrerInfoOutil($info);
	include ('inde_infoCreationInfoOutil.php');

}


?>