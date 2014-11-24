<?php
session_start();
?>

<?php
//	$nbArticles=count($_SESSION['inde_panier']['libelleProduit']);
//	$compteur = $nbArticles;

	if (isset ($_POST['acheterRef']))
	{
		$listeRef = $_SESSION['inde_listeRef'];

		foreach($listeRef as $idReference)
		{
			$qteProduit = $_POST['qte_'.$idReference];
			$qteProduit = trim($qteProduit);
			$qteProduitValide = str_replace(",", ".", $qteProduit);
			$qteProduit = $qteProduitValide;
			if($qteProduit > 0)
			{
//				if(in_array($idReference, $_SESSION['inde_panier']['idRef'],true))
				$pos=array_search($idReference,$_SESSION['inde_panier']['idRef']);
				if ($pos !== false) 
				{
					
					$_SESSION['inde_panier']['qteReference'][$pos] = $_SESSION['inde_panier']['qteReference'][$pos] + $qteProduit;
					$prixReference = $_POST['prix_'.$idReference];
					$_SESSION['inde_panier']['prixReference'][$pos] = $prixReference * $_SESSION['inde_panier']['qteReference'][$pos];
					
					$_SESSION['inde_montantPanier'] = $_SESSION['inde_montantPanier'] + $prixReference * $qteProduit;
				}
				else
				{
					$nomReference = $_POST['nom_'.$idReference];
					$prixReference = $_POST['prix_'.$idReference];
//$idFournisseur = $_POST['fournisseur_'.$idReference];					
					
					array_push( $_SESSION['inde_panier']['idRef'],$idReference);
					array_push( $_SESSION['inde_panier']['nomReference'],$nomReference);
					array_push( $_SESSION['inde_panier']['qteReference'],$qteProduit);
					array_push( $_SESSION['inde_panier']['prixReference'],$prixReference*$qteProduit);
//array_push( $_SESSION['inde_panier']['idFournisseur'],$idFournisseur);					
					
					$_SESSION['inde_nbRefPanier']++;
					$_SESSION['inde_montantPanier'] = $_SESSION['inde_montantPanier'] + ($prixReference*$qteProduit);
				}
			}
		}
	}
	
	include 'inde_1listeRefCategorie.php';
?>