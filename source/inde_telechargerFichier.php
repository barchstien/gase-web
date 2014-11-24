<?php
$file = $_POST['nomFic'];
header('Content-Transfer-Encoding: binary'); //Transfert en binaire (fichier)
header('Content-Disposition: attachment; filename='.basename($file)); //Nom du fichier
readfile($file); 
?>