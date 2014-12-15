<?php
    //this file was originally un-used, while it should be used by all !!!!!!!!

//avoid double insertion
if (!defined("FONCTION_BD_GASE_PHP")){
define("FONCTION_BD_GASE_PHP", 1);

//extract DB details from config.ini file
define ("CONFIG_FILE_PATH", "../config.ini");
$config = parse_ini_file(CONFIG_FILE_PATH, true);
define ("DB_ADDRESS", $config["DB"]["address"]);
define ("DB_USER", $config["DB"]["user"]);
define ("DB_PASS", $config["DB"]["password"]);
define ("DB_NAME", $config["DB"]["name"]);


function ConnectionBDD(){
	$connection = new mysqli(DB_ADDRESS, DB_USER, DB_PASS, DB_NAME);
	if ($connection->connect_errno) {
        exit("Failed to connect to MySQL: " . $connection->connect_error);
    }
    return $connection;
}

function FermerConnectionBDD($connection){
	$connection->close();
}

//this is imported from inde_fonctionsACH.php
function EnregistrerAchatAdherent($idAdherent, $montantTTC, $nbArticles){
	$connection = ConnectionBDD();

	$connection->query("INSERT INTO _inde_ACHATS (DATE_ACHAT,ID_ADHERENT,TOTAL_TTC,NB_REFERENCES) values(NOW(),'$idAdherent','$montantTTC','$nbArticles')");
	$idCommande = $connection->insert_id;
	
	FermerConnectionBDD($connection);
	return $idCommande;
}


//this is imported from inde_fonctionsACH.php
function SelectionInfosAchats($idAchats){
	$connection = ConnectionBDD();

	$result = $connection->query("SELECT DATE_ACHAT, TOTAL_TTC, NB_REFERENCES FROM _inde_ACHATS WHERE ID_ACHAT = '$idAchats'");
	$infosAchats = 0;
	while ( $row = $result->fetch_array()){
		$infosAchats = 'Detail des achats numero '. $idAchats . ' du ' . $row["DATE_ACHAT"] . ', d un montant de  ' . $row["TOTAL_TTC"] . ' euros ('.$row["NB_REFERENCES"].' references).';
	}
	FermerConnectionBDD($connection);
	return $infosAchats;
}
	
	
//this is imported from inde_fonctionsACH.php
function SelectionDetailsAchats($idAchats){
	$connection = ConnectionBDD();
	$compteur = 0;
	$result = $connection->query("SELECT r.DESIGNATION, r.PRIX_TTC, c.QUANTITE, r.PRIX_TTC*c.QUANTITE, c.ID_REFERENCE FROM _inde_STOCKS c, _inde_REFERENCES r WHERE c.ID_ACHAT = '$idAchats' AND r.ID_REFERENCE = c.ID_REFERENCE");
	while ( $row = $result->fetch_array())
	{		
		$ligne['DESIGNATION'] = $row[0];
		$ligne['PRIX_TTC'] = $row[1];
		$ligne['QUANTITE'] = $row[2];
		$ligne['TOTAL'] = ROUND($row[3],2);
		$ligne['ID_REFERENCE'] = $row[4];
		
		$listeRef[$compteur] = $ligne;
		$compteur++;
	}

	FermerConnectionBDD($connection);
	return $listeRef;
}


////////////*** JOURNAL DE BORD OUTIL ***////////////////
function EnregistrerInfoOutil($message){
	$connection = ConnectionBDD();
	$requete = "INSERT INTO _inde_VIE_OUTIL (DATE, MESSAGE) values(NOW(),'$message')";
	$connection->query($requete);
	FermerConnectionBDD($connection);
}

function SelectionListeMessages(){
	$connection = ConnectionBDD();
	$compteur = 0;
	$result = $connection->query("SELECT DATE, MESSAGE FROM _inde_VIE_OUTIL ORDER BY DATE DESC");
	while ( $row = $result->fetch_array()){
		$donnees['DATE'] = $row[0];
		$donnees['MESSAGE'] = $row[1];
		
		$listeMsg[$compteur] = $donnees;
		$compteur++;
	}
	FermerConnectionBDD($connection);
	return $listeMsg;
}

}//define "FONCTION_BD_GASE_PHP"
?>
