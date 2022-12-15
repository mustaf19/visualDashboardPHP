<?php
// require_once "dbconfig.php";
// require_once "relevanceChart.php";

$sql = "SELECT sector,COUNT(sector) as cnt FROM `data_1`GROUP by sector;";

$res = mysqli_query($conn,$sql);

$det = array();
$tol = 0;
while($details = mysqli_fetch_array($res)){
	$det[] =  array('region'=>$details['sector'],'Count'=> (int)($details['cnt']) );
	$tol += (int)($details['cnt']);

}
$dataPoints=array();
for($i=0;$i<count($det);$i++)
{
	$dataPoints[] = array("y" => $det[$i]['Count'], "label" => $det[$i]['region']);
}
 
?>
<script>
function sectorChart() {
 
var chart = new CanvasJS.Chart("sectorChart", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Sector Chart"
	},
	subtitles: [{
		text: "with every sector"
	}],
	data: [{
		type: "pie",
		// showInLegend: "false",
		// legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

	<div id="sectorChart" style="height: 370px; width: 100%;"></div>
    <script>sectorChart();</script>
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

