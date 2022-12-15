<script>
    function relevanceAppFun(){
        var data={};
        for(let i=0;i<preparedData.length;i++){
            data[preparedData[i][`relevance`]] = (data[preparedData[i][`relevance`]]||0) +1;
        }

        var relevanceChartList=[];
        for(const [key, value] of Object.entries(data)){
            relevanceChartList.push({
                "x": parseInt(key),
                "y": parseInt(value)
            });
        }
        
        
        var chart = new CanvasJS.Chart("relevanceAppChart", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "ligh2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Relevance Chart"
            },
            axisY:{
                includeZero: true
            },
            data: [{
                type: "bar", //change type to bar, line, area, pie, etc
                // indexLabel: "{y}", //Shows y value on all Data Points
                indexLabel: "{x} ({y})",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",   
                dataPoints: relevanceChartList
            }]
        });
        chart.render();
        
    }
</script>
<div id="relevanceAppChart" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>relevanceAppFun()</script>
