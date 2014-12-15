<?php 
header('WWW-Authenticate: Digest realm="Autentification"');
header('HTTP/1.0 401 Unauthorized');//envoi du code 401 authentification requise
header('Location: index.php');//redirection
exit();
 ?>
