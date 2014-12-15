<?php
	require("fonctions_bd_gase.php");

	function EnregistrerNouvelAdherent($nom, $prenom, $mail, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible)
	{
		$connection = ConnectionBDD();
		$requete = "INSERT INTO _inde_ADHERENTS (NOM, PRENOM, MAIL, TELEPHONE_FIXE, TELEPHONE_PORTABLE, ADRESSE, COMMENTAIRE, TICKET_CAISSE, DATE_INSCRIPTION, VISIBLE) values('$nom','$prenom','$mail','$telephone_fixe','$telephone_portable', '$adresse', '$commentaire', '$ticket', NOW(),'$visible')";
		$connection->query($requete);
		
		$result = $connection->query("SELECT MAX(ID_ADHERENT) FROM _inde_ADHERENTS");
		while ( $row = $result->fetch_array())
		{
			$idAdherentMax = $row[0];
		}
		
		$requete = "INSERT INTO _inde_COMPTES (ID_ADHERENT, SOLDE, DATE, OPERATION, MONTANT) values('$idAdherentMax',0,NOW(),'CREATION',0)";
		$connection->query($requete);
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeAdherents()
	{
		$connection = ConnectionBDD();

		$result = $connection->query("SELECT ID_ADHERENT, NOM FROM _inde_ADHERENTS ORDER BY NOM");
		while ( $row = $result->fetch_array())
		{
			$listeAdherents[$row["ID_ADHERENT"]] = $row["NOM"];
		}
		
		FermerConnectionBDD($connection);
		return $listeAdherents;
	}
	
	function SelectionDonneesAdherent($idAdherent)
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT NOM, PRENOM, MAIL, TELEPHONE_FIXE, TELEPHONE_PORTABLE, ADRESSE, COMMENTAIRE, TICKET_CAISSE, DATE_INSCRIPTION, VISIBLE FROM _inde_ADHERENTS WHERE ID_ADHERENT = '$idAdherent'");
		while ( $row = $result->fetch_array())
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
		}
		FermerConnectionBDD($connection);
		return $donnees;
	}
	
	function MajAdherent($idAdherent, $nom, $prenom, $email, $telephone_fixe, $telephone_portable, $adresse, $commentaire, $ticket, $visible)
	{
		$connection = ConnectionBDD();

		$requete = "UPDATE _inde_ADHERENTS SET NOM = '$nom', PRENOM = '$prenom', MAIL='$email', TELEPHONE_FIXE = '$telephone_fixe', TELEPHONE_PORTABLE = '$telephone_portable', ADRESSE = '$adresse', COMMENTAIRE = '$commentaire', TICKET_CAISSE = '$ticket', VISIBLE = '$visible' WHERE ID_ADHERENT = '$idAdherent'";
		$connection->query($requete);
		FermerConnectionBDD($connection);
	}
	
	function SelectionListeAD()
	{
		$connection = ConnectionBDD();
		$compteur = 0;
		$result = $connection->query("SELECT ID_ADHERENT, NOM, PRENOM FROM _inde_ADHERENTS ORDER BY NOM");
		while ( $row = $result->fetch_array())
		{		
			$donnees['ID_ADHERENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['PRENOM'] = $row[2];
			
			$listeAdherents[$compteur] = $donnees;
			$compteur++;
		}
		FermerConnectionBDD($connection);
		return $listeAdherents;
	}
	
	function SelectionListeActifsAD()
	{
		$connection = ConnectionBDD();
		$compteur = 0;
		$result = $connection->query("SELECT ID_ADHERENT, NOM, PRENOM FROM _inde_ADHERENTS WHERE VISIBLE = 1 ORDER BY NOM");
		while ( $row = $result->fetch_array())
		{		
			$donnees['ID_ADHERENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['PRENOM'] = $row[2];
			
			$listeAdherents[$compteur] = $donnees;
			$compteur++;
		}
		FermerConnectionBDD($connection);
		return $listeAdherents;
	}
	
	function SelectionPrenomNomAdherent($idAdherent)
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT PRENOM, NOM FROM _inde_ADHERENTS WHERE ID_ADHERENT = '$idAdherent'");
		while ( $row = $result->fetch_array())
		{
			$prenomAdherent = $row["PRENOM"];
			$nomAdherent = $row["NOM"];
		}
		FermerConnectionBDD($connection);
		return $prenomAdherent.' '.$nomAdherent.' ';
	}
	
	function SelectionListeAchatsAdherent($idAdherent)
	{
		$connection = ConnectionBDD();
		$compteur = 0;
		$result = $connection->query("SELECT c.ID_ACHAT, c.TOTAL_TTC, c.NB_REFERENCES, c.DATE_ACHAT FROM _inde_ACHATS c WHERE c.ID_ADHERENT = '$idAdherent' ORDER BY c.DATE_ACHAT DESC");
		while ( $row = $result->fetch_array())
		{		
			$ligne['ID_ACHATS'] = $row[0];
			$ligne['MONTANT'] = $row[1];
			$ligne['NB_ARTICLES'] = $row[2];
			$ligne['DATE_ACHATS'] = $row[3];
			
			$listeCde[$compteur] = $ligne;
			$compteur++;
		}
		FermerConnectionBDD($connection);
		return $listeCde;
	}
		
	function SelectionMailAdherentAD($idAdherent)
	{
		$connection = ConnectionBDD();

		$result = $connection->query("SELECT MAIL FROM _inde_ADHERENTS WHERE ID_ADHERENT= '$idAdherent'");
		$row = $result->fetch_array();
		$mail = $row["MAIL"];

		FermerConnectionBDD($connection);
		return $mail;
	}
	
	function SelectionAdherent_TicketCaisse($idAdherent)
	{
		$connection = ConnectionBDD();

		$result = $connection->query("SELECT TICKET_CAISSE FROM _inde_ADHERENTS WHERE ID_ADHERENT= '$idAdherent'");
		$row = $result->fetch_array();
		$ticket_caisse = $row["TICKET_CAISSE"];

		FermerConnectionBDD($connection);
		return $ticket_caisse;
	}
?>
