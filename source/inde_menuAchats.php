<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_menuAchats.css" />
        <title>ACHATS</title>
    </head>

	<?php
	require("inde_fonctionsCAT.php");
	$listeCategories = SelectionListeCategoriesMenu();
	?>
	
    <body>
		<div id="menu">
			<ul>
				<li><a href="index.php">Accueil</a></li>
				
				<?php
				foreach ($listeCategories as $tableau)
				{
					if(($tableau['SOUS_CATEGORIES'] == '0') && (empty($tableau['ID_CAT_SUP'])))
					{
					
						?>
						<li><a href="inde_1listeRefCategorie.php?idCategorie=<?php echo $tableau['ID_CATEGORIE']; ?>"><?php echo $tableau['NOM'];?></a></li>
						<?php
					}
					else if($tableau['SOUS_CATEGORIES'] != '0')
					{
						?>
						<li><a href="#"><?php echo $tableau['NOM']; ?></a>
							<ul>
							<?php
							$listeSousCategories = SelectionListeSousCategories($tableau['ID_CATEGORIE']);
							foreach ($listeSousCategories as $tableauSous)
							{
								?>
								<li><a href="inde_1listeRefCategorie.php?idCategorie=<?php echo $tableauSous['ID_CATEGORIE']; ?>"><?php echo $tableauSous['NOM'];?></a></li>
								<?php
							}
							?>
							</ul>
						</li>
						<?php
					}
				}
				?>				
			</ul>
		</div>
	</body>
</html>
