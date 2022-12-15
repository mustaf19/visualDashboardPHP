<?php
 $sql2 = 'SELECT relevance, COUNT(relevance) as cnt FROM `data_1` GROUP BY relevance;';
 $todb2 = mysqli_query($conn,$sql2);

 $det2 = array();
 $tot2=0;
 while($details2 = mysqli_fetch_array($todb2)){
	if($details2['relevance']=="")
	{
		$det2[] = array('Relevance'=>"Null",'Count'=> (int)($details2['cnt']) );
	}
	else{

		$det2[] = array('Relevance'=>$details2['relevance'],'Count'=> (int)($details2['cnt']) );
	}
 	$tot2+= $details2["cnt"];
 }
 // print_r($det);
$dataPoints2=array();
for($i=0;$i<count($det2);$i++)
{

	$label2 = $det2[$i]['Relevance'];
	$symbol2 = $det2[$i]['Relevance'];
	$dataPoints2[] = array("label"=>$label2, "symbol" => $symbol2,"y"=>(float)($det2[$i]['Count']/$tot2 *100) );

}
 
?>
<div>
	<script>
		const relevanceFun=()=> {
			const data = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>;
			var tmpdata=[];
			var count=0;
			for(var i=0;i<data.length;i++)
			{
				if(document.getElementById(data[i][`label`]).checked ==true  )
				{
					tmpdata.push(data[i]);
					count+=1;
				}

			}
			if(count==0){
				relevanceChartFun(data);
			}
			else{
				relevanceChartFun(tmpdata);
			}
		}

		function relevanceChartFun(data = <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>) {
		 
			var relevanceChartFun = new CanvasJS.Chart("relevanceChart", {
				theme: "light2",
				animationEnabled: true,
				title: {
					text: "Relevance Types Pie chart"
				},
				data: [{
					type: "doughnut",
					indexLabel: "{symbol} - {y}",
					yValueFormatString: "#,##0.0\"%\"",
					showInLegend: true,
					legendText: "{label} : {y}",
					dataPoints: data
				}]
			});
			relevanceChartFun.render();
		 
		}
	</script>
	<div>
		
		<div id="relevanceChart" style="height: 370px; width: 100%;">click2!</div>
		<script>relevanceChartFun();</script>
		<?php
			echo '<div>';
			for($i=0;$i<count($dataPoints2);$i++)
			{
				echo '<input type="checkbox" style="display:inline-block" onclick="relevanceFun()" id="'.$dataPoints2[$i]['label'].'"/><label for="'.$dataPoints2[$i]['label'].'">'.$dataPoints2[$i]['label'].'</label><br>';
			}
			echo '</div>';
		?>
		
	</div>
</div>     