<?php
require("inde_fonctionsAD.php"); 

include 'inde_menu.php';
 
// Si le formulaire a été envoyé
if (isset ($_POST['modifierAdherent']))
{
	$idAdherent= $_POST['idAdherent'];
	
	$nom = $_POST['nom'];
	$nom = trim($nom);
	$nom = str_replace("'", "_", $nom);
	$nom = strtoupper($nom);
	
	if(empty($nom))
	{
		print("<center>Le '<b>NOM</b>' de l adherent n est pas renseigne ! Creation a refaire.</center>");
	}
	else
	{
		$ticket = $_POST['ticket'];
		$email = $_POST['email'];
		if($ticket == 1)
		{
			if(empty($email))
			{
				print("<center>Pour envoyer un ticket de caisse, il faut renseigner l '<b>EMAIL</b>' ! Creation a refaire.</center>");
			}
			else
			{
				$prenom = $_POST['prenom'];
				$prenom = trim($prenom);
				$prenom = str_replace("'", "_", $prenom);
				
				$email = $_POST['email'];
				$telephone_fixe = $_POST['telephoneFixe'];
				$telephone_portable = $_POST['telephonePortable'];
				
				$adresse = $_POST['adresse'];
				$adresse = trim($adresse);
				$adresse = str_replace("'", "_", $adresse);
				
				$commentaire = $_POST['commentaire'];
				$commentaire = trim($commentaire);
				$commentaire = str_replace("'", "_", $commentaire);
				
				$visible = $_POST['visible'];
				
				MajAdherent($idAdherent, $nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible);
				echo 'Mise a jour des donnees de ' . $prenom . ' ' . $nom . ' enregistree.';
			}
		}
	}
}
?>
