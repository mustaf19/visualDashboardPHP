<script>
    function cityAppFun(){
        var data={};
        for(let i=0;i<preparedData.length;i++){
            data[preparedData[i][`city`]] = (data[preparedData[i][`city`]]||0) +1;
        }

        var cityChartList=[];
        for(const [key, value] of Object.entries(data)){
            // console.log(cityChartList);
            cityChartList.push({
                "x": key,
                "y": parseInt(value)
            });
        }
        
        
        var chart = new CanvasJS.Chart("cityAppChart", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "ligh1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "City Chart"
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
                dataPoints: cityChartList
            }]
        });
        chart.render();
        
    }
</script>
<div id="cityAppChart" style="height: 370px; width: 100%;"></div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>cityAppFun()</script>
