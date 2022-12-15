<script>
    function regionAppFun(){
        var data={};
        for(let i=0;i<preparedData.length;i++){
            data[preparedData[i][`region`]] = (data[preparedData[i][`region`]]||0) +1;
        }

        var regionChartList=[];
        for(const [key, value] of Object.entries(data)){
            // console.log(regionChartList);
            regionChartList.push({
                "x": key,
                "y": parseInt(value)
            });
        }
        
        
        var chart = new CanvasJS.Chart("regionAppChart", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Region Chart"
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
                dataPoints: regionChartList
            }]
        });
        chart.render();
        
    }
</script>
<div id="regionAppChart" style="height: 370px; width: 100%;"></div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>regionAppFun()</script>
