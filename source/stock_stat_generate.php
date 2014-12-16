<?php
//if fonctions_bd_gase.php is included, the chart is not generated...
//... so need to use only base php here
//require_once("fonctions_bd_gase.php");

//get path to pChart
define ("GASE_CONFIG_FILE_PATH", "../config.ini");
$config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
$pChart_path = $config["pCHART"]["path"];
////GET parameters
$id_reference = $_GET['id'];
$year_stats = 0;
if (isset($_GET['year'])){
    $year_stats = $_GET['year'];
}
//debug
$year = 2014;

////Connect to DB
$address = $config["DB"]["address"];
$user = $config["DB"]["user"];
$pass = $config["DB"]["password"];
$name =  $config["DB"]["name"];
$connection = new mysqli($address, $user, $pass, $name);
if ($connection->connect_errno) {
    error_log("Failed to connect to MySQL: " . $connection->connect_error);
    exit("Failed to connect to MySQL: " . $connection->connect_error);
}
////get
$months = range(1, 12);
$weeks = range(0, 53);
$listeAchats = array();
$listeStocks = array();
foreach($months as $m){
    $result = $connection->query(
        "SELECT SUM(QUANTITE), DATE_FORMAT(DATE, '%Y-%m')
        FROM _inde_STOCKS
        WHERE ID_REFERENCE = $id_reference
            AND OPERATION = 'ACHAT'
            AND YEAR(DATE) = $year
            AND MONTH(DATE) = $m
        ORDER BY DATE"
    );
    $row = $result->fetch_array();
    $listeAchats[] = array($row[0], $year."-".str_pad($m, 2, '0', STR_PAD_LEFT));
}

/*
$result = $connection->query(
    //"SELECT STOCK, DATE
    "SELECT SUM(QUANTITE), DATE_FORMAT(DATE, '%Y-%m')
    FROM _inde_STOCKS
    WHERE ID_REFERENCE = $id_reference
    AND OPERATION = 'ACHAT'
    AND YEAR(DATE) = $year
    GROUP BY MONTH(DATE)
    ORDER BY DATE");
$listeStocks = array();
$tmp_date;
if ($result != false){
    while($row = $result->fetch_array()){
	    $listeStocks[] = array($row[0], $row[1]);
	    //error_log(strtotime($row[1]));
    }
}*/

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
for($i=0;$i<count($listeAchats);$i++){
    //$MyData->addPoints(rand(1,15),"Probe 1");
    $MyData->addPoints($listeAchats[$i][0],"Achats ".$year);
    $MyData->addPoints($listeAchats[$i][1],"Labels");
}
//$MyData->setSerieTicks("Probe 2",4);
$MyData->setAxisName(0,"Unités/Kg/Litres");


$MyData->setSerieDescription("Labels","Date");
$MyData->setAbscissa("Labels");
//$MyData->setXAxisDisplay(AXIS_FORMAT_DATE, "d/m/y");
$MyData->setXAxisDisplay(AXIS_FORMAT_CUSTOM,"XAxisFormat");
function XAxisFormat($Value) { return($Value);}//date("d/m/Y",strtotime($Value)));}

$width = 1200;
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
$myPicture->setGraphArea(60,40,$width-10,$height-50);

/* Draw the scale */
//,"LabelSkip"=>10
$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"GridAlpha"=>100,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE
,"LabelRotation"=>30,"LabelingMethod"=>LABELING_ALL);
$myPicture->drawScale($scaleSettings);

/* Write the chart legend */
$myPicture->drawLegend(640,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

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
