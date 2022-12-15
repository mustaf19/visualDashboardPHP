<script>
    function countryAppFun(){
        var data={};
        for(let i=0;i<preparedData.length;i++){
            data[preparedData[i][`country`]] = (data[preparedData[i][`country`]]||0) +1;
        }

        var countryChartList=[];
        for(const [key, value] of Object.entries(data)){
            // console.log(countryChartList);
            countryChartList.push({
                "x": key,
                "y": parseInt(value)
            });
        }
        
        
        var chart = new CanvasJS.Chart("countryAppChart", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "ligh1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Country Chart"
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
                dataPoints: countryChartList
            }]
        });
        chart.render();
        
    }
</script>
<div id="countryAppChart" style="height: 370px; width: 100%;"></div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>countryAppFun()</script>
