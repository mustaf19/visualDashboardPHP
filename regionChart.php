<?php
// require_once "dbconfig.php";
// require_once "relevanceChart.php";

$sql = "SELECT region, COUNT(region) as cnt FROM `data_1` GROUP by region";

$res = mysqli_query($conn,$sql);

$det = array();
$tol = 0;
while($details = mysqli_fetch_array($res)){
	$det[] =  array('region'=>$details['region'],'Count'=> (int)($details['cnt']) );
	$tol += (int)($details['cnt']);

}
$dataPoints=array();
for($i=0;$i<count($det);$i++)
{
	$dataPoints[] = array("y" => (float)$det[$i]['Count']/$tol *100, "label" => $det[$i]['region']);
}
 
?>
<div>
<script>
		function fun(){
		// const fun =()=>{
		const chart = new CanvasJS.Chart("regionChart", {
			animationEnabled: true,
			theme: "light2",
			title:{
				text: "Region Chart"
			},
			axisY: {
				title: "Count"
			},
			data: [{
				type: "column",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();
		 
		}
	</script>
	<div id="regionChart" style="height: 370px; width: 100%;"></div>
	<script>fun();</script>
</div>             