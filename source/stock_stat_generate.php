<?php
//if fonctions_bd_gase.php is included, the chart is not generated...
//... so need to use only base php here
//require_once("fonctions_bd_gase.php");

// AC 02-05-2016 DB_PREFIX

//get path to pChart
define ("GASE_CONFIG_FILE_PATH", "../config.ini");
$config = parse_ini_file(GASE_CONFIG_FILE_PATH, true);
$pChart_path = $config["libs"]["pChart_path"];
////GET parameters
$id_reference = $_GET['id'];
$year_stats = $_GET['year'];


////Connect to DB
$address = $config["DB"]["address"];
$user = $config["DB"]["user"];
$pass = $config["DB"]["password"];
$name =  $config["DB"]["name"];
$prefix = $config["DB"]["prefix"];

if ($prefix == '') $prefix = '_inde_';
//$connection = new mysqli($address, $user, $pass, $name);
$dsn = "mysql:host=$address;dbname=$name";
$mysql = new PDO($dsn, $user, $pass);

/*if ($connection->connect_errno) {
    error_log("Failed to connect to MySQL: " . $connection->connect_error);
    exit("Failed to connect to MySQL: " . $connection->connect_error);
}*/
define("DB_PREFIX", $prefix);

/* pChart library inclusions */
//included here to use th VOID constant that correspond to no data for a serie
include($pChart_path."/class/pData.class.php");
include($pChart_path."/class/pDraw.class.php");
include($pChart_path."/class/pImage.class.php");

////create data to plot
$weeks = range(1, 54);
$min_scale = 0;
$max_scale = 0;
$MyData = new pData();

//get sum of quantity bought for each week
foreach($weeks as $w){
    ////Sum purchase
    $result = $mysql->query(
        "SELECT SUM(QUANTITE), MIN(DATE_FORMAT(DATE, '%M %D'))
        FROM ".DB_PREFIX."STOCKS
        WHERE ID_REFERENCE = $id_reference
            AND OPERATION = 'ACHAT'
            AND YEAR(DATE) = $year_stats
            AND WEEK(DATE,1) = $w
        ORDER BY DATE"
    );
    $row = $result->fetch();
    if ($row != NULL){
        //compute day corresponding to the start of the week
        $week_start = new DateTime();
        $week_start->setISODate($year_stats, $w);
        $now = new DateTime();
        $d = $now->diff($week_start);
        if (1 == $d->invert){
            //$now > $week_start - $week_start is NOT in future, value is relevant
            $MyData->addPoints($row[0],"Achats");
        }else{
            $MyData->addPoints(VOID,"Achats");
        }
        $MyData->addPoints($week_start->format('j-M'),"Date");
    }
    
    ////Stocks Minimum & Maximum
    $result = $mysql->query(
        "SELECT MIN(STOCK), MAX(STOCK), MIN(DATE_FORMAT(DATE, '%M %D'))
        FROM ".DB_PREFIX."STOCKS
        WHERE ID_REFERENCE = $id_reference
            AND YEAR(DATE) = $year_stats
            AND WEEK(DATE,1) = $w
        ORDER BY DATE"
    );
    $row = $result->fetch();
    if (1 == $d->invert){
        $MyData->addPoints($row[1],"Stock");
        $MyData->addPoints($row[0],"Floating 0");
    }else{
        $MyData->addPoints(VOID,"Stock");
        $MyData->addPoints(VOID,"Floating 0");
    }
}


//////////// MAKE the CHART /////////////
$width = 1200;
$height = 500;

//disable the span lower edge
$MyData->setSerieDrawable("Floating 0", false);
$MyData->setSerieDescription("Stock","Stock (min/max)"); 

//set series color
$MyData->setPalette("Stock", array("R"=>204,"G"=>102,"B"=>0,"Alpha"=>250));
$MyData->setPalette("Achats", array("R"=>0,"G"=>0,"B"=>255,"Alpha"=>250));

$MyData->setAxisName(0,"Unités/Kg/Litres");
$MyData->setAbscissa("Date");
//$MyData->setXAxisDisplay(AXIS_FORMAT_DATE, "d/m/y");
////// ???  correct ??$MyData->setXAxisName(0,"Unités/Kg/Litres");
$MyData->setXAxisDisplay(AXIS_FORMAT_CUSTOM,"XAxisFormat");
function XAxisFormat($Value) { return($Value);}//date("d/m/Y",strtotime($Value)));}

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
$myPicture->setFontProperties(array("FontName"=>$pChart_path."/fonts/calibri.ttf","FontSize"=>10));
$myPicture->drawText(250,35,"Achats et Stock (min/max) par semaine",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Define the chart area */
$myPicture->setGraphArea(50,50,$width-10,$height-60);

/* Write the chart legend */
$myPicture->drawLegend($width-300,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontSize"=>15));

/* Set the default font */
$myPicture->setFontProperties(array("FontName"=>$pChart_path."/fonts/Bedizen.ttf","FontSize"=>12));

/* Draw the scale */
//$AxisBoundaries = array(0=>array("Min"=>-500,"Max"=>500));
//$scaleSettings = array("LabelRotation"=>40, "Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries);
$scaleSettings = array("LabelRotation"=>40);

$myPicture->drawScale($scaleSettings);

/* Turn on Antialiasing */
$myPicture->Antialias = TRUE;

/* Enable shadow computing */
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

////////////// Bar chart
$MyData->setSerieDrawable("Achats", false);
$MyData->setSerieDrawable("Stock", true);
//$myPicture->drawBarChart();
$settings = array("Floating0Serie"=>"Floating 0","Surrounding"=>10);
$myPicture->drawBarChart($settings);

////////////////// Line chart
$MyData->setSerieDrawable("Stock", false);
$MyData->setSerieDrawable("Achats", true);

/* Draw the area chart */
$Threshold = "";
/*$Threshold[] = array("Min"=>0,"Max"=>5,"R"=>187,"G"=>220,"B"=>0,"Alpha"=>100);
$Threshold[] = array("Min"=>5,"Max"=>10,"R"=>240,"G"=>132,"B"=>20,"Alpha"=>100);
$Threshold[] = array("Min"=>10,"Max"=>20,"R"=>240,"G"=>91,"B"=>20,"Alpha"=>100);
*/
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawAreaChart(array("Threshold"=>$Threshold));

/* Draw a line chart over */
$myPicture->drawLineChart(array("ForceColor"=>TRUE,"ForceR"=>0,"ForceG"=>0,"ForceB"=>0));

/* Draw a plot chart over */
$myPicture->drawPlotChart(array("PlotBorder"=>TRUE,"BorderSize"=>1,"Surrounding"=>-255,"BorderAlpha"=>80));

//header('Content-Type: image/png');
/* Render the picture (choose the best way) */
//$myPicture->autoOutput("pictures/example.drawAreaChart.threshold.png");
$myPicture->stroke();
?>
