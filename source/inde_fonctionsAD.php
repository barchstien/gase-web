<?php
	require("fonctions_bd_gase.php");

	/*
	 * AC 15-04-2016 nouvelle connexion mysql
	 * AC 02-05-2016 fonction globale requete()
	 */	
	
	function EnregistrerNouvelAdherent($nom, $prenom, $mail, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible)
	{
		$requete = "INSERT INTO _inde_ADHERENTS (NOM, PRENOM, MAIL, TELEPHONE_FIXE, TELEPHONE_PORTABLE, ADRESSE, COMMENTAIRE, TICKET_CAISSE, DATE_INSCRIPTION, VISIBLE) values('$nom','$prenom','$mail','$telephone_fixe','$telephone_portable', '$adresse', '$commentaire', '$ticket', NOW(),'$visible')";
		requete($requete);
		
		$result = requete("SELECT MAX(ID_ADHERENT) FROM _inde_ADHERENTS");
		while ( $row = $result->fetch())
		{
			$idAdherentMax = $row[0];
		}
		
		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherentMax',0,NOW(),'CREATION',0)";
		requete($requete);
	}
	
	function SelectionListeAdherents()
	{

		$result = requete("SELECT ID_ADHERENT, NOM FROM _inde_ADHERENTS ORDER BY NOM");
		while ( $row = $result->fetch())
		{
			$listeAdherents[$row["ID_ADHERENT"]] = $row["NOM"];
		}
		
		return $listeAdherents;
	}
	
	function SelectionDonneesAdherent($idAdherent)
	{
		$result = requete("SELECT NOM, PRENOM, MAIL, TELEPHONE_FIXE, TELEPHONE_PORTABLE, ADRESSE, COMMENTAIRE, TICKET_CAISSE, DATE_INSCRIPTION, VISIBLE, RECEIVE_ALERT_STOCK FROM _inde_ADHERENTS WHERE ID_ADHERENT = '$idAdherent'");
		while ( $row = $result->fetch())
		{		
			$donnees['NOM'] = $row[0];
			$donnees['PRENOM'] = $row[1];
			$donnees['MAIL'] = $row[2];
			$donnees['TELEPHONE_FIXE'] = $row[3];
			$donnees['TELEPHONE_PORTABLE'] = $row[4];
			$donnees['ADRESSE'] = $row[5];
			$donnees['COMMENTAIRE'] = $row[6];
			$donnees['TICKET_CAISSE'] = $row[7];
			$donnees['DATE_INSCRIPTION'] = $row[8];
			$donnees['VISIBLE'] = $row[9];
			$donnees['RECEIVE_ALERT_STOCK'] = $row[10];
		}
		return $donnees;
	}
	
	function MajAdherent($idAdherent, $nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible, $receive_alert_stock)
	{

		$requete = "UPDATE _inde_ADHERENTS SET NOM = '$nom', PRENOM = '$prenom', MAIL='$email', TELEPHONE_FIXE = '$telephone_fixe', TELEPHONE_PORTABLE = '$telephone_portable', ADRESSE = '$adresse', COMMENTAIRE = '$commentaire', TICKET_CAISSE = '$ticket', VISIBLE = '$visible', RECEIVE_ALERT_STOCK = '$receive_alert_stock' WHERE ID_ADHERENT = '$idAdherent'";
		requete($requete);
	}
	
	function SelectionListeAD()
	{
		$compteur = 0;
		$result = requete("SELECT ID_ADHERENT, NOM, PRENOM FROM _inde_ADHERENTS ORDER BY NOM");
		while ( $row = $result->fetch())
		{		
			$donnees['ID_ADHERENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['PRENOM'] = $row[2];
			
			$listeAdherents[$compteur] = $donnees;
			$compteur++;
		}
		return $listeAdherents;
	}
	
	function SelectionListeActifsAD()
	{
		$compteur = 0;
		$result = requete("SELECT ID_ADHERENT, NOM, PRENOM FROM _inde_ADHERENTS WHERE VISIBLE = 1 ORDER BY NOM");
		while ( $row = $result->fetch())
		{		
			$donnees['ID_ADHERENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['PRENOM'] = $row[2];
			
			$listeAdherents[$compteur] = $donnees;
			$compteur++;
		}
		return $listeAdherents;
	}
	
	function SelectionPrenomNomAdherent($idAdherent)
	{
		$result = requete("SELECT PRENOM, NOM FROM _inde_ADHERENTS WHERE ID_ADHERENT = '$idAdherent'");
		while ( $row = $result->fetch())
		{
			$prenomAdherent = $row["PRENOM"];
			$nomAdherent = $row["NOM"];
		}
		return $prenomAdherent.' '.$nomAdherent.' ';
	}
	
	function SelectionListeAchatsAdherent($idAdherent)
	{
		$compteur = 0;
		$result = requete("SELECT c.ID_ACHAT, c.TOTAL_TTC, c.NB_REFERENCES, c.DATE_ACHAT FROM _inde_ACHATS c WHERE c.ID_ADHERENT = '$idAdherent' ORDER BY c.DATE_ACHAT DESC");
		$listeCde = [];
		while ( $row = $result->fetch())
		{		
			$ligne['ID_ACHATS'] = $row[0];
			$ligne['MONTANT'] = $row[1];
			$ligne['NB_ARTICLES'] = $row[2];
			$ligne['DATE_ACHATS'] = $row[3];
			
			$listeCde[$compteur] = $ligne;
			$compteur++;
		}
		return $listeCde;
	}
		
	function SelectionMailAdherentAD($idAdherent)
	{

		$result = requete("SELECT MAIL FROM _inde_ADHERENTS WHERE ID_ADHERENT= '$idAdherent'");
		$row = $result->fetch();
		$mail = $row["MAIL"];

		return $mail;
	}
	
	function SelectionAdherent_TicketCaisse($idAdherent)
	{

		$result = requete("SELECT TICKET_CAISSE FROM _inde_ADHERENTS WHERE ID_ADHERENT= '$idAdherent'");
		$row = $result->fetch();
		$ticket_caisse = $row["TICKET_CAISSE"];

		return $ticket_caisse;
	}
?>
