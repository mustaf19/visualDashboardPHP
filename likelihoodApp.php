<script>
    function likelihoodAppFun(){
        var data={};
        for(let i=0;i<preparedData.length;i++){
            data[preparedData[i][`likelihood`]] = (data[preparedData[i][`likelihood`]]||0) +1;
        }

        var likelihoodChartList=[];
        for(const [key, value] of Object.entries(data)){
            likelihoodChartList.push({
                "x": parseInt(key),
                "y": parseInt(value)
            });
        }
        
        
        var chart = new CanvasJS.Chart("likelihoodAppChart", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "ligh2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Likelihood Chart"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "pie", //change type to bar, line, area, pie, etc
                // indexLabel: "{y}", //Shows y value on all Data Points
                indexLabel: "{x} ({y})",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",   
                dataPoints: likelihoodChartList
            }]
        });
        chart.render();
        
    }
</script>
<div id="likelihoodAppChart" style="height: 370px; width: 100%;"></div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>likelihoodAppFun()</script>
