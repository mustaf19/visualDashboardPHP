<script>
	function intensityAppFun() {
		var data={};
		for(let i=0;i<preparedData.length;i++){
			data[preparedData[i][`intensity`]] = (data[preparedData[i][`intensity`]]||0) +1;
		}

		var intensityChartList=[];
		for(const [key, value] of Object.entries(data)){
			intensityChartList.push({
				"x": parseInt(key),
				"y": parseInt(value)
			})
		}
		
		
		var chart = new CanvasJS.Chart("intensityAppChart", {
			animationEnabled: true,
			exportEnabled: true,
			theme: "ligh2", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Intensity Chart"
			},
			axisY:{
				includeZero: true
			},
			data: [{
				type: "line", //change type to bar, line, area, pie, etc
				//indexLabel: "{y}", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",   
				dataPoints: intensityChartList
			}]
		});
		chart.render();
		
	}
</script>
<div id="intensityAppChart" ></div>
<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<script>intensityAppFun()</script>
