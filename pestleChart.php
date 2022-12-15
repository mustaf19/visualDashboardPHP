
<?php
$sql = "SELECT pestle,COUNT(pestle) as cnt FROM `data_1` GROUP BY pestle;";

$res = mysqli_query($conn,$sql);

$det = array();
while($details = mysqli_fetch_array($res)){
    if($details['pestle']=="")
    {
        $det[] =  array('region'=>"Null Values",'Count'=> (int)($details['cnt']) );

    }
    else{

        $det[] =  array('region'=>$details['pestle'],'Count'=> (int)($details['cnt']) );
    }

}
$dataPoints=array();
for($i=0;$i<count($det);$i++)
{
	$dataPoints[] = array("y" => $det[$i]['Count'], "label" => $det[$i]['region']);
}
 
?>
<script>
    const pestleCheckFun=()=>{
        const initk = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?> ;
        const t =[];
        // Boolean noNull = false;
        // if(document.getElementById("pestleNoNull") == true)
        // {
        //     noNull=true;
        // }
        var count=0;
        const st=0;
        if(document.getElementById(initk[0][`label`]) == true)
        {
            st=1;
        }
        for(var i=st;i<initk.length;i++)
        {
            var tmp = document.getElementById(initk[i][`label`]);
            if(tmp.checked == true)
            {
                t.push(initk[i]);
                count+=1;
            }

        }
        if(count==0)
        {
            pestleFun(initk);
        }
        else{

            pestleFun(t);
        }
        
    }

function pestleFun(k=<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>) {
var chart = new CanvasJS.Chart("pestleChart", {

	animationEnabled: true,
	title:{
		text: "Pestle Chart"
	},
	axisY: {
		title: "Frequency",
		includeZero: true,
	},
	data: [{
		type: "bar",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: k
	}]
});
chart.render();
 
}
</script>
<div>
   
    <div id="pestleChart" style="height: 500px; width: 100%;"></div>
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script>pestleFun();</script>
    <?php 
    for($i=0;$i<count($dataPoints);$i++)
    {
        $id = $dataPoints[$i]["label"];
        echo '<label>'.$dataPoints[$i]["label"].'</label><input onclick="pestleCheckFun();" type="checkbox" id="'.$id.'" />  ';
    }
    ?>
</div>
                