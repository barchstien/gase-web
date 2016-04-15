<?php
//avoid double insertion
if (!defined("FONCTION_BD_GASE_PHP")){
define("FONCTION_BD_GASE_PHP", 1);

//path to config file
define ("GASE_CONFIG_FILE_PATH", "../config.ini");

/*
 * AC 15-04-2016
 * Connexion à la base de données avec PDO et variable globale
 *  - dans les fonctions, appeler la connexion avec `global $mysql`
 *  - remplacer $connection par $mysql pour les query()
 *  - remplacer fetch_array() par fetch() car différent avec PDO
 * TODO: la prochaine étape sera d'encapsuler tout ça dans une classe pour
 * ne pas avoir à utiliser de variable globale
 */
// récupérer paramètres du config.ini
$config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
$address = $config["DB"]["address"];
$user = $config["DB"]["user"];
$pass = $config["DB"]["password"];
$name =  $config["DB"]["name"];
// construction chaîne de connexion
$dsn = "mysql:host=$address;dbname=$name";
// variable globale 
// => utilisation d'une connexion persistante, pas de besoin de fermée, elle est mise en cache et réutilisée ensuite 
$mysql = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));

//this is imported from inde_fonctionsACH.php
function EnregistrerAchatAdherent($idAdherent, $montantTTC, $nbArticles){
	global $mysql;

	$mysql->query("INSERT INTO _inde_ACHATS (DATE_ACHAT,ID_ADHERENT,TOTAL_TTC,NB_REFERENCES) values(NOW(),'$idAdherent','$montantTTC','$nbArticles')");
	$idCommande = $mysql->insert_id;
	
	return $idCommande;
}


//this is imported from inde_fonctionsACH.php
function SelectionInfosAchats($idAchats){
	global $mysql;

	$result = $mysql->query("SELECT DATE_ACHAT, TOTAL_TTC, NB_REFERENCES FROM _inde_ACHATS WHERE ID_ACHAT = '$idAchats'");
	$infosAchats = 0;
	while ( $row = $result->fetch()){
		$infosAchats = 'Detail des achats numero '. $idAchats . ' du ' . $row["DATE_ACHAT"] . ', d un montant de  ' . $row["TOTAL_TTC"] . ' euros ('.$row["NB_REFERENCES"].' references).';
	}
	return $infosAchats;
}
	
	
//this is imported from inde_fonctionsACH.php
function SelectionDetailsAchats($idAchats){
	global $mysql;
	$compteur = 0;
	$result = $mysql->query("SELECT r.DESIGNATION, r.PRIX_TTC, c.QUANTITE, r.PRIX_TTC*c.QUANTITE, c.ID_REFERENCE FROM _inde_STOCKS c, _inde_REFERENCES r WHERE c.ID_ACHAT = '$idAchats' AND r.ID_REFERENCE = c.ID_REFERENCE");
	while ( $row = $result->fetch())
	{		
		$ligne['DESIGNATION'] = $row[0];
		$ligne['PRIX_TTC'] = $row[1];
		$ligne['QUANTITE'] = $row[2];
		$ligne['TOTAL'] = ROUND($row[3],2);
		$ligne['ID_REFERENCE'] = $row[4];
		
		$listeRef[$compteur] = $ligne;
		$compteur++;
	}

	return $listeRef;
}


////////////*** JOURNAL DE BORD OUTIL ***////////////////
function EnregistrerInfoOutil($message){
	global $mysql;
	$requete = "INSERT INTO _inde_VIE_OUTIL (DATE, MESSAGE) values(NOW(),'$message')";
	$mysql->query($requete);
}

function SelectionListeMessages(){
	global $mysql;
	$compteur = 0;
	$result = $mysql->query("SELECT DATE, MESSAGE FROM _inde_VIE_OUTIL ORDER BY DATE DESC");
	while ( $row = $result->fetch()){
		$donnees['DATE'] = $row[0];
		$donnees['MESSAGE'] = $row[1];
		
		$listeMsg[$compteur] = $donnees;
		$compteur++;
	}
	return $listeMsg;
}

function RemoveMessage($date){
	global $mysql;
	$mysql->query("DELETE FROM _inde_VIE_OUTIL WHERE DATE='$date'");
}

//////////////// EMAIL ////////////////
///TODO  Too much open/read of confgi.ini that could be reduced into one
function get_email_origin(){
    //extract email origin from config.ini file
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    return $config["EMAIL"]["origin"];
}

function get_email_subject(){
    //extract email origin from config.ini file
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    return $config["EMAIL"]["subject"];
}

/** return NULL if not debug, else the debug email destination */
function get_email_debug_destination(){
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    $debug = $config["EMAIL"]["debug"];
    $ret = null;
    if ($debug){
        $ret = $config["EMAIL"]["debug_destination"];
    }
    return $ret;
}

function should_use_gmail(){
    //extract email origin from config.ini file
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    return $config["EMAIL"]["use_gmail"];
}

function get_gmail_user(){
    //extract email origin from config.ini file
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    return $config["EMAIL"]["gmail_user"];
}

function get_gmail_pass(){
    //extract email origin from config.ini file
    $config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
    return $config["EMAIL"]["gmail_pass"];
}

}//end of define "FONCTION_BD_GASE_PHP"
?>
