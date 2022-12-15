<?php
    $sql = "SELECT intensity,COUNT(intensity) as cnt FROM `data_1` GROUP BY intensity;";

    $res = mysqli_query($conn,$sql);
    
    $dataPoints = array();
    while($details = mysqli_fetch_array($res)){
        if($details['intensity']=="")
        {
            $dataPoints[] = array("y" => (int)($details['cnt']), "label" => "Null Values");
    
        }
        else{
    
            $dataPoints[] = array("y" => (int)($details['cnt']), "label" => $details['intensity']);
        }
    
    }
?>

<script>
    const intensityChartFun= ()=> {
    
    var chart = new CanvasJS.Chart("intensitychartContainer", {
        title: {
            text: "Intensity Chart"
        },
        axisY: {
            title: "Intensity Count"
        },
        data: [{
            type: "line",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
 
    }
</script>
<div>
    <div id="intensitychartContainer" style="height: 370px; width: 100%;"></div>
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script>intensityChartFun()</script>
</div> 