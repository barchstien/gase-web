
<?php
session_start();

	$idRef = $_GET['idRef'];
	
	$compteur = 0;
	$trouve = 0;
	while ($trouve == 0)
	{
	
		if($_SESSION['inde_panier']['idRef'][$compteur] == $idRef)
		{
			$trouve = 1;
			$_SESSION['inde_montantPanier'] = $_SESSION['inde_montantPanier'] - $_SESSION['inde_panier']['prixReference'][$compteur];
			$_SESSION['inde_nbRefPanier']--;
			unset($_SESSION['inde_panier']['idRef'][$compteur]);
			$_SESSION['inde_panier']['idRef'] = array_values($_SESSION['inde_panier']['idRef']);
			unset($_SESSION['inde_panier']['nomReference'][$compteur]);
			$_SESSION['inde_panier']['nomReference'] = array_values($_SESSION['inde_panier']['nomReference']);
			unset($_SESSION['inde_panier']['qteReference'][$compteur]);
			$_SESSION['inde_panier']['qteReference'] = array_values($_SESSION['inde_panier']['qteReference']);
			unset($_SESSION['inde_panier']['prixReference'][$compteur]);
			$_SESSION['inde_panier']['prixReference'] = array_values($_SESSION['inde_panier']['prixReference']);
		}
		$compteur++;
	}

	//include 'inde_1listeRefCategorie.php';
    //rediret to list of reference + panier
    header('location:inde_1listeRefCategorie.php');
?>

