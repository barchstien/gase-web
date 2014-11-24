<?php
require("inde_fonctionsDOCU.php");

	include 'inde_menu.php';
 
$dossier = './archives/';
$nomFichier = basename($_FILES['le_fichier']['name']);
$nomFichier = str_replace(' ', '_', $nomFichier);
$nomFichier = str_replace("'", '_', $nomFichier);

//$tailleFichier = basename($_FILES['le_fichier']['size']);
 
$idDocument = SelectionIdDocument() + 1; 
$nomFichierStock = $dossier . "-" . $idDocument . "-" . $nomFichier;
 
	// Si le formulaire a été envoyé
	if (isset ($_POST['enregistrer']))
	{
		$idType = $_POST['idType'];
		if($idType == 1)
		{
//			$nom = $_POST['nom'];
//			$nom = stripslashes(str_replace("'", "_", $nom));
			$idFournisseur = $_POST['fournisseur'];
			$date = $_POST['date'];
			$date = stripslashes(str_replace("'", "_", $date));
			$net = $_POST['net'];
			$net = stripslashes(str_replace("'", "_", $net));
			
			$upload = upload('le_fichier',$nomFichierStock,1048576, array('pdf','doc','xls') );
			EnregistrerNouvelleFacture($idType, $nomFichier, $idFournisseur, $date, $net);
			echo 'Nouvelle facture ' . $nomFichier . ' archivee.';
		}
		else if($idType == 2)
		{
//			$nom = $_POST['nom'];
//			$nom = stripslashes(str_replace("'", "_", $nom));
			$idFournisseur = $_POST['fournisseur'];
			$date = $_POST['date'];
			$date = stripslashes(str_replace("'", "_", $date));
			$net = $_POST['net'];
			$net = stripslashes(str_replace("'", "_", $net));
			
			$upload = upload('le_fichier',$nomFichierStock,1048576, array('pdf','doc','xls') );
			EnregistrerNouveauBonCde($idType, $nomFichier, $idFournisseur, $date, $net);
			echo 'Nouveau bon de commande ' . $nomFichier . ' archive.';
		}
		else if($idType == 3)
		{
//			$nom = $_POST['nom'];
//			$nom = stripslashes(str_replace("'", "_", $nom));
			$date = $_POST['date'];
			$date = stripslashes(str_replace("'", "_", $date));
			
			$upload = upload('le_fichier',$nomFichierStock,1048576, array('pdf','doc','xls') );
			EnregistrerNouveauDocInterne($idType, $nomFichier, $date);
			echo 'Nouveau document interne ' . $nomFichier . ' archive.';
		}
	}
	
	function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}
?>
