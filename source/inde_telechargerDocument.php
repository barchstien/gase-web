<?php
$fichier = $_POST['nomDocument'];

//First, see if the file exists
    if (!is_file($fichier)) { die("<b>404 File not found!</b>"); }

    //Gather relevent info about file
    $len = filesize($fichier);
    $filename = basename($fichier);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    //This will set the Content-Type to the appropriate setting for the file
    switch( $file_extension ) {
      case "pdf": $ctype="application/pdf"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
   
      default: $ctype="application/force-download";
    }

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
   
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");

    //Force the download
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header);
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    readfile($fichier);

//header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
//header('Content-Disposition: attachment; filename='.basename($file)); //Nom du fichier
//readfile($fichier); 
/* 
if (file_exists($file)) { 
header('Content-Description: File Transfer'); 
header('Content-Type: application/octet-stream'); 
header('Content-Disposition: attachment; filename='.basename($file)); 
header('Content-Transfer-Encoding: binary'); 
header('Expires: 0'); 
header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
header('Pragma: public'); 
header('Content-Length: ' . filesize($file)); 
ob_clean(); 
flush(); 
readfile($file); 
exit;
}  
*/ 



/*Après avoir vérifié que le fichier existe (l'id est bien dans la BDD) et
  après avoir sélectionné les informations sur le fichier dans la BDD (dans $bdd_infos) */
/* 
//Création des headers, pour indiquer au navigateur qu'il s'agit d'un fichier à télécharger
  header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
  header('Content-Disposition: attachment; filename="'.$bdd_infos['up_final'].'"'); //Nom du fichier
  header('Content-Length: '.$bdd_infos['up_filesize']); //Taille du fichier
 
//Envoi du fichier dont le chemin est passé en paramètre
  readfile($bdd_infos['up_filename']);
*/  
  
/**		
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
 
//Commentaire
$dossier = '../archives/';
$nomFichier = basename($_FILES['le_fichier']['name']);
$tailleFichier = basename($_FILES['le_fichier']['size']);
$typeFichier= $_GET[type];
$description = $_POST['description'];
$fournisseurFichier = $_POST['fournisseurFichier'];
$jourFichier = $_POST['jourFichier'];
$moisFichier = $_POST['moisFichier'];
$anneeFichier = $_POST['anneeFichier'];
$date = $anneeFichier . $moisFichier . $jourFichier;
$nomFichierStock = $dossier . $fournisseurFichier . "-" .$anneeFichier . $moisFichier . $jourFichier . "-" . $nomFichier;
**/
/*
if(move_uploaded_file($_FILES['le_fichier']['tmp_name'], $dossier . $nomFichierStock)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
{
echo '<br/><br/>Upload effectué avec succès !';
}
else //Sinon (la fonction renvoie FALSE).
{
echo '<br/><br/>Echec de l\'upload !';
}
*/
/**$upload = upload('le_fichier',$nomFichierStock,1048576, array('pdf','doc') );

EnregistrerDoc($nomFichier, $tailleFichier, $typeFichier, $description, $date, $nomFichierStock, $fournisseurFichier);

 
if ($upload) echo "Enregistrement du fichier réussi!<br />";
else echo '<br/><br/>Echec de l\'enregistrement (extension differente de .pdf ou .doc ou fichier trop gros) !';
**/
?>
