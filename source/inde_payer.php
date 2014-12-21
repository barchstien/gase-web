<?php

session_start();

require("inde_fonctionsSTK.php");
require("inde_fonctionsMC.php");
require("inde_fonctionsAD.php");

//get path to PHPMailer
$config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
$PHPMailer_path = $config["libs"]["PHPMailer_path"];
require($PHPMailer_path."/PHPMailerAutoload.php");

$soldeAdherent = SelectionSoldeAdherentMC($_SESSION['inde_adherent']);
if (isset ($_POST['payer']))
{
	//Vérifie si le montant de la commande est supérieur à 0.
	$totalTTC = $_SESSION['inde_montantPanier'];
	if($totalTTC > 0)
	{
	    //la maison fait crédit de 20Euro max !!
		if($totalTTC <= $soldeAdherent+20)
		{
			$nbRef = $_SESSION['inde_nbRefPanier'];
			$idAdherent = $_SESSION['inde_adherent'];
			DepenseMC($idAdherent,$totalTTC);
			$nouveauSolde = SelectionSoldeAdherentMC($idAdherent);
			$numeroAchat = EnregistrerAchatAdherent($idAdherent, $totalTTC, $nbRef);
			for ($compteur = 0; $compteur < $nbRef; $compteur++){
				AchatSTK($numeroAchat, $_SESSION['inde_panier']['idRef'][$compteur], $_SESSION['inde_panier']['qteReference'][$compteur]);
			}
			
			//only send if user subscribed for it
			if (SelectionAdherent_TicketCaisse($idAdherent) == 1){
                generate_email($idAdherent, $totalTTC);
            }
            
			echo "Achats " . $numeroAchat . " enregistree.<br />";
			echo "<div style=\"text-align:center\">Le solde de votre compte est maintenant de " . round($nouveauSolde, 2) . " euros.</div>";
			echo "Merci.<br />";
			echo "
			    <br />
			    <li>Pour aller a la page d'accueil : <a href=\"index.php\">cliquez ici</a></li>
			";
		}
		else
		{
			echo "<div style=\"text-align:center; color: #FF0000\">Attention, le total de vos achats et superieur au solde de votre compte MoneyCoop.<br />Veuillez approvisionner votre MoneyCoop avant de re-enregistrer vos achats.</div>";  
			echo "
			    <br>
			    <li>Pour modifier votre panier  <a href=\"javascript:window.history.back()\">cliquez ici</a></li>
			    <li>Pour aller a la page d accueil : <a href=\"index.php\">cliquez ici</a></li>
			";
		}
	}
	else
	{
		include '1listeRefCategorie.php'; 
		echo 'Le panier est vide. Pas de commande enregistree';
	}
}



function generate_email($idAdherent, $totalTTC){
    /************* ENVOI MAIL ****************/
    $date = date("d-m-Y H:i:s");
    $nouveauSolde = SelectionSoldeAdherentMC($idAdherent);

    // Déclaration de l'adresse de destination
    $mail = stripslashes(SelectionMailAdherentAD($idAdherent));
    //usual microsoft shit, which needs special newline
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){
	    $passage_ligne = "\r\n";
    }else{
	    $passage_ligne = "\n";
    }
    //=====Déclaration des messages au format texte et au format HTML
    /* Message texte */
    $message_txt = "Vos achats du " . $date . "\n";
    for($i = 0; $i < count($_SESSION['inde_panier']['nomReference']); $i++){
	    $message_txt .= "  - " . 
	        //name product
	        stripslashes($_SESSION['inde_panier']['nomReference'][$i]) . 
	        //quantity bought
	        " ".$_SESSION['inde_panier']['qteReference'][$i]." x " . 
	            round($_SESSION['inde_panier']['prixReference'][$i] / $_SESSION['inde_panier']['qteReference'][$i], 2) . "euro" .
	        //total price for this product
	        "  [ " . round($_SESSION['inde_panier']['prixReference'][$i],2) . " euros ]\n"; 	 	
    }
    $message_txt .= "\nTOTAL TTC : " . round($totalTTC,2) . " euros.\n"; 
    $message_txt .= "Le solde de votre compte MoneyCoop est maintenant de : " . round($nouveauSolde, 2) . " euros.\n";
    $message_txt .= "Merci.";

    //=====Définition du sujet (config.ini)
    $subject = get_email_subject();
     
    //=====Création du header de l'e-mail (config.ini)
    $origin = get_email_origin();
     
    //=====Envoi de l'e-mail
    //if email in debug mode, send to alternate destination...
    //... this avoid bothering real users while testing
    $debug_destination = get_email_debug_destination();
    if ($debug_destination != null){
        //debug, sent to the test email
        //send_email_using_gmail($debug_destination, $origin, $subject." -debug- ", $message_txt);
        $mail = $debug_destination;
        $subject .= " -debug- ";
    }
    if (should_use_gmail()){
        send_email_using_gmail($mail, $origin, $subject, $message_txt);
    }else{
        send_email_using_php_mail($mail, $origin, $subject, $message_txt);
    }
}

function send_email_using_gmail($dst, $origin, $subject, $message){
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = get_gmail_user();
    //Password to use for SMTP authentication
    $mail->Password = get_gmail_pass();
    //Set who the message is to be sent from
    ////$mail->setFrom('gasiersdelesclain@example.com', 'Les Gasiers de l\'Esclain');
    $mail->setFrom($origin);
    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    $mail->addAddress($dst);
    //Set the subject line
    $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    $mail->Body = $message;
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo."<br>";
    } else {
        echo "Ticket envoyé à ".$dst."<br>";
    }
}

function send_email_using_php_mail($dst, $origin, $subject, $message_txt){
    //usual microsoft shit, which needs special newline
    $passage_ligne = "\n";
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $dst)){
	    $passage_ligne = "\r\n";
    }
    
    //=====Création de la boundary
    $boundary = "-----=".md5(rand());

    //=====Création du header de l'e-mail.
    $header = "From: <".$origin.">".$passage_ligne;
    $header.= "Reply-to: <".$origin.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========
     
    //=====Envoi de l'e-mail
    mail($dst, $subject, $message, $header);
}

?>

