<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>Inventaire : Ecarts</title>
    </head>

    <body>
		<?php include 'inde_menu.php';
		require("inde_fonctionsSTK.php");
		$inventaire_list = get_inventaires_dates();
		?>
		
        <div style="text-align:center;position:relative;top:-20px;z-index:0;">
            <form action="inventaire_ecarts.php" method="GET">
            <strong>Inventaire du : </strong>
            <select name="inventaire_date" onchange="this.form.submit()">
                <?php foreach($inventaire_list as $i){
                    echo "<option value='$i'>$i</option>";
                }?>
            </select>
            </form>
        </div>
	</body>
</html>
