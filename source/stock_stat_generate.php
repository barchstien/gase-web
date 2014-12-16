<?php
//if this line is enabled, the chart is not generated
//require_once("fonctions_bd_gase.php");

define ("GASE_CONFIG_FILE_PATH", "../config.ini");
$id_reference = $_GET['id'];
error_log($id_reference);
$config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
$pChart_path = $config["pCHART"]["path"];
//$pChart_path = "../pChart";


$address = $config["DB"]["address"];
$user = $config["DB"]["user"];
$pass = $config["DB"]["password"];
$name =  $config["DB"]["name"];
$connection = new mysqli($address, $user, $pass, $name);
if ($connection->connect_errno) {
    exit("Failed to connect to MySQL: " . $connection->connect_error);
}

$sec_in_a_month = 2682000;//2678400;
$result = $connection->query(
    //"SELECT STOCK, DATE
    "SELECT SUM(QUANTITE), DATE_FORMAT(DATE, '%Y-%m') as DateOnly
    FROM _inde_STOCKS
    WHERE ID_REFERENCE = $id_reference
    AND OPERATION = 'ACHAT'
    AND (UNIX_TIMESTAMP() - UNIX_TIMESTAMP(DATE)) < (60*60*24*31*24)
    GROUP BY DateOnly
    ORDER BY DATE");
$listeStocks = array();
$tmp_date;
if ($result != false){
    while($row = $result->fetch_array()){
	    if (count($listeStocks) > 0){
	        $cnt = strtotime(end($listeStocks)[1]);
	        $cnt2 = strtotime($row[1]);
	        //if (($cnt2 - $cnt) > $sec_in_a_month){
	        while (($cnt2 - $cnt) > $sec_in_a_month){
	            error_log("MORE BETWEEN : ".end($listeStocks)[1]." - ".$row[1]."_____".($cnt2 - $cnt));
	            $cnt += $sec_in_a_month;
	            $listeStocks[] = array(end($listeStocks)[0], date("Y-m",$cnt));
	        }
	    }
	
	    $listeStocks[] = array($row[0], $row[1]);
	    //error_log(strtotime($row[1]));
	
    }
}

$connection->close();



/* CAT:Area Chart */

/* pChart library inclusions */
include($pChart_path."/class/pData.class.php");
include($pChart_path."/class/pDraw.class.php");
include($pChart_path."/class/pImage.class.php");

/* Create and populate the pData object */
$MyData = new pData();
//for($i=0;$i<=30;$i++){
$cnt = 0;
for($i=0;$i<count($listeStocks);$i++){
    //$MyData->addPoints(rand(1,15),"Probe 1");
    $MyData->addPoints($listeStocks[$i][0],"Probe 1");
    $MyData->addPoints($listeStocks[$i][1],"Labels");
}
//$MyData->setSerieTicks("Probe 2",4);
$MyData->setAxisName(0,"Unités/Kg/Litres");


$MyData->setSerieDescription("Labels","Date");
$MyData->setAbscissa("Labels");
//$MyData->setXAxisDisplay(AXIS_FORMAT_DATE, "d/m/y");
$MyData->setXAxisDisplay(AXIS_FORMAT_CUSTOM,"XAxisFormat");
function XAxisFormat($Value) { return($Value);}//date("d/m/Y",strtotime($Value)));}

$width = 900;
$height = 450;
/* Create the pChart object */
$myPicture = new pImage($width,$height,$MyData);

/* Turn of Antialiasing */
$myPicture->Antialias = FALSE;

/* Add a border to the picture */
$myPicture->drawGradientArea(0,0,$width,$height,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
$myPicture->drawGradientArea(0,0,$width,$height,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,$width-1,$height-1,array("R"=>0,"G"=>0,"B"=>0));

/* Write the chart title */ 
$myPicture->setFontProperties(array("FontName"=>$pChart_path."/fonts/Forgotte.ttf","FontSize"=>11));
$myPicture->drawText(150,35,"Achats par mois",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Set the default font */
$myPicture->setFontProperties(array("FontName"=>$pChart_path."/fonts/pf_arma_five.ttf","FontSize"=>10));

/* Define the chart area */
$myPicture->setGraphArea(60,40,$width-50,$height-80);

/* Draw the scale */
//,"LabelSkip"=>10
$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"GridAlpha"=>100,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE
,"LabelRotation"=>30,"LabelingMethod"=>LABELING_ALL);
$myPicture->drawScale($scaleSettings);

/* Write the chart legend */
//$myPicture->drawLegend(640,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

/* Turn on Antialiasing */
$myPicture->Antialias = TRUE;

/* Enable shadow computing */
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

/* Draw the area chart */
$Threshold = "";
/*$Threshold[] = array("Min"=>0,"Max"=>5,"R"=>187,"G"=>220,"B"=>0,"Alpha"=>100);
$Threshold[] = array("Min"=>5,"Max"=>10,"R"=>240,"G"=>132,"B"=>20,"Alpha"=>100);
$Threshold[] = array("Min"=>10,"Max"=>20,"R"=>240,"G"=>91,"B"=>20,"Alpha"=>100);
*/
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20));
$myPicture->drawAreaChart(array("Threshold"=>$Threshold));

/* Draw a line chart over */
$myPicture->drawLineChart(array("ForceColor"=>TRUE,"ForceR"=>0,"ForceG"=>0,"ForceB"=>0));

/* Draw a plot chart over */
$myPicture->drawPlotChart(array("PlotBorder"=>TRUE,"BorderSize"=>1,"Surrounding"=>-255,"BorderAlpha"=>80));

/* Write the thresholds */
//$myPicture->drawThreshold(5,array("WriteCaption"=>TRUE,"Caption"=>"Warn Zone","Alpha"=>70,"Ticks"=>2,"R"=>0,"G"=>0,"B"=>255));
//$myPicture->drawThreshold(10,array("WriteCaption"=>TRUE,"Caption"=>"Error Zone","Alpha"=>70,"Ticks"=>2,"R"=>0,"G"=>0,"B"=>255));

//header('Content-Type: image/png');
/* Render the picture (choose the best way) */
//$myPicture->autoOutput("pictures/example.drawAreaChart.threshold.png");
$myPicture->stroke();
?>