<?php
{
    //all data
    $sql = "SELECT * FROM `data_1`";
    $res = mysqli_query($conn,$sql);
    
    $dataPoints = array();
    while($details = mysqli_fetch_array($res)){
        $dataPoints[] = array('relevance'=>$details['relevance'],'likelihood'=>$details['likelihood'],'intensity'=>$details['intensity'],'end_year'=>$details['end_year'],'topic'=>$details['topic'],'region'=>$details['region'],'pestle'=>$details['pestle'],'source'=>$details['source'],'swot'=>$details['swot'],'country'=>$details['country'],'city'=>$details['city']);
        // $dataPoints[] = array($details);
    }

    //ONLY FOR ENDYEAR
    $sql = "SELECT DISTINCT(end_year) FROM `data_1` order by end_year ASC";
    $res = mysqli_query($conn,$sql);
    
    $end_year = array();
    while($details = mysqli_fetch_array($res)){
        $end_year[] = array("year"=>$details['end_year']);

    }



    //ONLY FOR SECTOR
    $sector = array();
    $sql = "SELECT DISTINCT(sector) FROM `data_1` GROUP by sector;";
    $res = mysqli_query($conn,$sql);
    
    $sector = array();
    while($details = mysqli_fetch_array($res)){
        $sector[] = array("sector"=>$details['sector']);

    }

    //ONLY FOR TOPICS
    $topic = array();
    $sql = "SELECT DISTINCT(topic) FROM `data_1` GROUP by topic;";
    $res = mysqli_query($conn,$sql);
    
    $topic = array();
    while($details = mysqli_fetch_array($res)){
        $topic[] = array("topic"=>$details['topic']);

    }

    //ONLY FOR REGION
    $region = array();
    $sql = "SELECT DISTINCT(region) FROM `data_1` GROUP by region;";
    $res = mysqli_query($conn,$sql);
    
    $region = array();
    while($details = mysqli_fetch_array($res)){
        $region[] = array("region"=>$details['region']);

    }

    //ONLY FOR PESTLE
    $pestle = array();
    $sql = "SELECT DISTINCT(pestle) FROM `data_1` GROUP by pestle;";
    $res = mysqli_query($conn,$sql);
    
    $pestle = array();
    while($details = mysqli_fetch_array($res)){
        $pestle[] = array("pestle"=>$details['pestle']);

    }


    //ONLY FOR SOURCE
    $source = array();
    $sql = "SELECT DISTINCT(source) FROM `data_1` GROUP by source;";
    $res = mysqli_query($conn,$sql);
    
    $source = array();
    while($details = mysqli_fetch_array($res)){
        $source[] = array("source"=>$details['source']);

    }

    //ONLY FOR SWOT
    $swot = array();
    $sql = "SELECT DISTINCT(swot) FROM `data_1` GROUP by swot;";
    $res = mysqli_query($conn,$sql);
    
    $swot = array();
    while($details = mysqli_fetch_array($res)){
        $swot[] = array("swot"=>$details['swot']);

    }
    //ONLY FOR COUNTRY
    $country = array();
    $sql = "SELECT DISTINCT(country) FROM `data_1` GROUP by country;";
    $res = mysqli_query($conn,$sql);
    
    $country = array();
    while($details = mysqli_fetch_array($res)){
        $country[] = array("country"=>$details['country']);

    }
    //ONLY FOR CITY
    $city = array();
    $sql = "SELECT DISTINCT(city) FROM `data_1` GROUP by city;";
    $res = mysqli_query($conn,$sql);
    
    $city = array();
    while($details = mysqli_fetch_array($res)){
        $city[] = array("city"=>$details['city']);

    }

    

}
?>
<script>
    var sql="";
    var querySQL;
    var data = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
    var preparedData=data;
    // console.log(data);

    // all list to contain options
    var end_yearList = [];
    var topicList = [];
    var regionList = [];
    var pestleList = [];
    var sourceList = [];
    var swotList = [];
    var countryList = [];
    var cityList = [];

    function resetFun(){
         end_yearList = [];
     topicList = [];
     regionList = [];
     pestleList = [];
     sourceList = [];
     swotList = [];
     countryList = [];
     cityList = [];
     document.getElementById('selectedEndYear').innerHTML = "";
     document.getElementById('selectedTopic').innerHTML = "";
     document.getElementById('selectedCity').innerHTML = "";
     document.getElementById('selectedRegion').innerHTML = "";
     document.getElementById('selectedCountry').innerHTML = "";
     document.getElementById('selectedPestle').innerHTML = "";
     document.getElementById('selectedSource').innerHTML = "";
     document.getElementById('selectedSwot').innerHTML = "";
     prepareData();
    }
    //LIST ADDITION FUNCTIONS
    function end_yearAdditionFun(){
        var sd = document.getElementById('end_year').value;
        end_yearList.push(sd);
        end_yearList = [... new Set(end_yearList)];
        var options="";
        for(let i=0;i<end_yearList.length;i++){
            options+= `<div id="${end_yearList[i]}" onclick="end_yearDeletionFun('${end_yearList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${end_yearList[i]}</div>`+" ";
        }
        document.getElementById('selectedEndYear').innerHTML = options;
        // queryFun();
        prepareData();
        // intensityAppFun();

        
    }
    const topicAdditionFun=()=>{
        var sd = document.getElementById('topic').value;
        topicList.push(sd);
        topicList = [... new Set(topicList)];
        var options="";
        for(let i=0;i<topicList.length;i++){
            options+= `<div id="${topicList[i]}" onclick="topicDeletionFun('${topicList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${topicList[i]}</div>`+" ";
        }
        document.getElementById('selectedTopic').innerHTML = options;
        prepareData();

        

    }
    const regionAdditionFun=()=>{
        var sd = document.getElementById('region').value;
        regionList.push(sd);
        regionList = [... new Set(regionList)];
        var options="";
        for(let i=0;i<regionList.length;i++){
            options+= `<div id="${regionList[i]}" onclick="regionDeletionFun('${regionList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${regionList[i]}</div>`+" ";
        }
        document.getElementById('selectedRegion').innerHTML = options;
        prepareData();


    }
    const pestleAdditionFun=()=>{
        var sd = document.getElementById('pestle').value;
        pestleList.push(sd);
        pestleList = [... new Set(pestleList)];
        var options="";
        for(let i=0;i<pestleList.length;i++){
            options+= `<div id="${pestleList[i]}" onclick="pestleDeletionFun('${pestleList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${pestleList[i]}</div>`+" ";
        }
        document.getElementById('selectedPestle').innerHTML = options;
        prepareData();

    }
    const sourceAdditionFun=()=>{
        var sd = document.getElementById('source').value;
        sourceList.push(sd);
        sourceList = [... new Set(sourceList)];
        var options="";
        for(let i=0;i<sourceList.length;i++){
            options+= `<div id="${sourceList[i]}" onclick="sourceDeletionFun('${sourceList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${sourceList[i]}</div>`+" ";
        }
        document.getElementById('selectedSource').innerHTML = options;
        prepareData();

    }
    const swotAdditionFun=()=>{
        var sd = document.getElementById('swot').value;
        swotList.push(sd);
        swotList = [... new Set(swotList)];
        var options="";
        for(let i=0;i<swotList.length;i++){
            options+= `<div id="${swotList[i]}" onclick="swotDeletionFun('${swotList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${swotList[i]}</div>`+" ";
        }
        document.getElementById('selectedSwot').innerHTML = options;
        prepareData();

    }
    const countryAdditionFun=()=>{
        var sd = document.getElementById('country').value;
        countryList.push(sd);
        countryList = [... new Set(countryList)];
        var options="";
        for(let i=0;i<countryList.length;i++){
            options+= `<div id="${countryList[i]}" onclick="countryDeletionFun('${countryList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${countryList[i]}</div>`+" ";
        }
        document.getElementById('selectedCountry').innerHTML = options;
        prepareData();

    }
    const cityAdditionFun=()=>{
        var sd = document.getElementById('city').value;
        cityList.push(sd);
        cityList = [... new Set(cityList)];
        var options="";
        for(let i=0;i<cityList.length;i++){
            options+= `<div id="${cityList[i]}" onclick="cityDeletionFun('${cityList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${cityList[i]}</div>`+" ";
        }
        document.getElementById('selectedCity').innerHTML = options;
        prepareData();

    }

    //LIST DELETION FUNCTIONS
function end_yearDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = end_yearList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<end_yearList.length;i++)
            {
                if(i!=idx){
                    tmp.push(end_yearList[i]);

                }
            }

            var options = "";
            end_yearList = tmp;
            for(let i=0;i<end_yearList.length;i++){
                options+= `<div id="${end_yearList[i]}" onclick="end_yearDeletionFun('${end_yearList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${end_yearList[i]}</div>`+" ";
            }
            document.getElementById('selectedEndYear').innerHTML = options;   
        }
        // queryFun();
        prepareData();
    }

function topicDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = topicList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<topicList.length;i++)
            {
                if(i!=idx){
                    tmp.push(topicList[i]);

                }
            }

            var options = "";
            topicList = tmp;
            for(let i=0;i<topicList.length;i++){
                options+= `<div id="${topicList[i]}" onclick="topicDeletionFun('${topicList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${topicList[i]}</div>`+" ";
            }
            document.getElementById('selectedTopic').innerHTML = options; 
            
        }
        prepareData(); 

    }
function regionDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = regionList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<regionList.length;i++)
            {
                if(i!=idx){
                    tmp.push(regionList[i]);

                }
            }

            var options = "";
            regionList = tmp;
            for(let i=0;i<regionList.length;i++){
                options+= `<div id="${regionList[i]}" onclick="regionDeletionFun('${regionList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${regionList[i]}</div>`+" ";
            }
            document.getElementById('selectedRegion').innerHTML = options; 
            prepareData();  
        }

    }
function pestleDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = pestleList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<pestleList.length;i++)
            {
                if(i!=idx){
                    tmp.push(pestleList[i]);

                }
            }

            var options = "";
            pestleList = tmp;
            for(let i=0;i<pestleList.length;i++){
                options+= `<div id="${pestleList[i]}" onclick="pestleDeletionFun('${pestleList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${pestleList[i]}</div>`+" ";
            }
            document.getElementById('selectedPestle').innerHTML = options; 
            prepareData();  
        }

    }
function sourceDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = sourceList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<sourceList.length;i++)
            {
                if(i!=idx){
                    tmp.push(sourceList[i]);

                }
            }

            var options = "";
            sourceList = tmp;
            for(let i=0;i<sourceList.length;i++){
                options+= `<div id="${sourceList[i]}" onclick="sourceDeletionFun('${sourceList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${sourceList[i]}</div>`+" ";
            }
            document.getElementById('selectedSource').innerHTML = options;
            prepareData();   
        }

    }
function swotDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = swotList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<swotList.length;i++)
            {
                if(i!=idx){
                    tmp.push(swotList[i]);

                }
            }

            var options = "";
            swotList = tmp;
            for(let i=0;i<swotList.length;i++){
                options+= `<div id="${swotList[i]}" onclick="swotDeletionFun('${swotList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${swotList[i]}</div>`+" ";
            }
            document.getElementById('selectedSwot').innerHTML = options; 
            prepareData();  
        }


    }
function countryDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = countryList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<countryList.length;i++)
            {
                if(i!=idx){
                    tmp.push(countryList[i]);

                }
            }

            var options = "";
            countryList = tmp;
            for(let i=0;i<countryList.length;i++){
                options+= `<div id="${countryList[i]}" onclick="countryDeletionFun('${countryList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${countryList[i]}</div>`+" ";
            }
            document.getElementById('selectedCountry').innerHTML = options;  
            prepareData(); 
        }

    }
    function cityDeletionFun(id){
        var val = document.getElementById(id).innerHTML;
        var tmp=[];
        var idx = cityList.indexOf(val);
        if(idx>-1){
            for(let i=0;i<cityList.length;i++)
            {
                if(i!=idx){
                    tmp.push(cityList[i]);

                }
            }

            var options = "";
            cityList = tmp;
            for(let i=0;i<cityList.length;i++){
                options+= `<div id="${cityList[i]}" onclick="cityDeletionFun('${cityList[i]}')" style="display:inline-block;border: 1px solid black; border-radius: 5px; padding: 3px;">${cityList[i]}</div>`+" ";
            }
            document.getElementById('selectedCity').innerHTML = options;   
            prepareData();
        }

    }
    const queryFun =()=>{
        
        sql ="SELECT * from `data_v`";
        count=0;
        if(end_yearList.length>0)
        {
            if(count>0)
            {
                sql += " and"
            }
            count+=1;
            sql+= " where end_year in ";
            var tmp = "(\"";
            tmp += end_yearList.join("\",\"")
            tmp += "\")";
            console.log(tmp);
            sql+= " "+ tmp;
            console.log(sql);
        }

    }

   function prepareData(){
    // data = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

    
	var tmp=[];
	if(end_yearList.length!=0)
	{
		for(let i=0;i<data.length;i++)
		{
			if(end_yearList.includes(data[i][`end_year`]+""))
			{
                tmp.push(data[i]);
			}
		}
	}
    else if(end_yearList.length==0){
        tmp=data;
	}

	var tmp2=[];
	if(topicList.length!=0)
	{
		for(let i=0;i<tmp.length;i++){
			if(topicList.includes(tmp[i][`topic`]+"")){
                tmp2.push(tmp[i]);
			}
		}
	}
	else if(topicList.length==0){
        tmp2=tmp;
	}

	var tmp3=[];
	if(regionList.length!=0)
	{
		for(let i=0;i<tmp2.length;i++){
			if(regionList.includes(tmp2[i][`region`]+"")){
				tmp3.push(tmp2[i]);
			}
		}
	}
	else{
		tmp3=tmp2;
	}

	tmp4=[];
	if(pestleList.length!=0)
	{
		for(let i=0;i<tmp3.length;i++){
			if(pestleList.includes(tmp3[i][`pestle`]+"")){
				tmp4.push(tmp3[i]);
			}
		}
	}
	else{
		tmp4=tmp3;
	}

	tmp5=[];
	if(sourceList.length!=0)
	{
		for(let i=0;i<tmp4.length;i++){
			if(sourceList.includes(tmp4[i][`source`]+"")){
				tmp5.push(tmp4[i]);
			}
		}
	}
	else{
		tmp5=tmp4;
	}

	tmp6=[];
	if(swotList.length!=0)
	{
		for(let i=0;i<tmp5.length;i++){
			if(swotList.includes(tmp5[i][`swot`]+"")){
				tmp6.push(tmp5[i]);
			}
		}
	}
	else{
		tmp6=tmp5;
	}

	tmp7=[];
	if(countryList.length!=0)
	{
		for(let i=0;i<tmp6.length;i++){
			if(countryList.includes(tmp6[i][`country`]+"")){
				tmp7.push(tmp6[i]);
			}
		}
	}
	else{
		tmp7=tmp6;
	}

	preparedData=[];
	if(cityList.length!=0)
	{
		for(let i=0;i<tmp7.length;i++){
			if(cityList.includes(tmp7[i][`city`]+"")){
				preparedData.push(tmp7[i]);
			}
		}
	}
	else{
		preparedData=tmp7;
	}
    document.getElementById('countDataEntries').innerHTML = "Data entries found :"+preparedData.length; 
    console.log("Count:"+preparedData.length);
    likelihoodAppFun();
    intensityAppFun();
    cityAppFun();
    countryAppFun();
    relevanceAppFun();
    regionAppFun();

}

</script>
<style>
        .intensityAppBox,.regionAppBox,.countryAppBox,.cityAppBox,.likelihoodAppBox,.relevanceAppBox{
                border: 1px solid white;
                border-radius: 5px;
                height: 500px;
                margin: 10px;
                display: block;
                background-color: white;
                box-shadow: 10px 10px 50px rgb(255, 139, 139);
                padding: 20px;
            }
            .AppBox{
                display: grid;
                background-color: wheat;
                grid-template-columns:50% 50%;
                /* grid-gap: 30px; */
            }
            .filterAppForm{
                border: 5px solid gray;
                padding: 20px;
                background-color: white;
                border-radius: 10px;
                display: grid;
                grid-template-columns: 50% 50%;
                
            }

            #source{
                max-width: 300px;
            }

            .select{
                    max-width: 300px;
                }

            .intensityAppBox{
                grid-column:1/-1;
            }
            .relevanceAppBox{
                grid-column: 1/-1;
            }
            .indChart{
                grid-column: 1/-1;
            }

            label{
                padding:10px;
                margin: 0;

            }

            .filtersclass{
                border: 5px solid gray;
                padding: 20px;
                background-color: white;
                border-radius: 10px;
            }
            @media only screen and (max-width: 750px) {
                .AppBox{
                    grid-template-columns: 100%;

                }


                .filterAppForm{
                    grid-template-columns: 100%;
                }
            }
        </style>
<div>

    <form class="filterAppForm">
        
        <!-- ENDYEAR -->
        <label for="end_year">End Year
        <select id="end_year" onchange="end_yearAdditionFun()" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($end_year);$i++)
                {
                    if($end_year[$i]["year"]=="")       //Null to deal with  blank
                    {
                        $end_year[$i]["year"]="Null";
                    }
                    echo '<option>'.$end_year[$i]["year"].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->

        <!-- TOPICS -->
        <label for="topics">Topics
        <select id="topic" onchange="topicAdditionFun()" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($topic);$i++)
                {
                    if($topic[$i]["topic"]=="")
                    {
                        $topic[$i]["topic"]="Null";
                    }
                    echo '<option>'.$topic[$i]["topic"].'</option>';
                }
            ?>
        </select></label>

        <!-- region -->
        <label for="region">Region
        <select id="region" onchange="regionAdditionFun();" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($region);$i++)
                {
                    echo '<option>'.$region[$i]['region'].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->


        <!-- pestle -->
        <label for="pestle">Pestle
        <select id="pestle" onchange="pestleAdditionFun();" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($pestle);$i++)
                {
                    echo '<option>'.$pestle[$i]['pestle'].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->


        <!-- source -->
        <label for="source" style="max-width: 300px">Source
        <select id="source" onchange="sourceAdditionFun();" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($source);$i++)
                {
                    echo '<option>'.$source[$i]['source'].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->


        <!-- swot -->
        <label for="swot">Swot
        <select id="swot" onchange="swotAdditionFun();" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($swot);$i++)
                {
                    echo '<option>'.$swot[$i]['swot'].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->


        <!-- country -->
        <div>
            <label for="country">Country
            <select id="country" onchange="countryAdditionFun();" class="slct">
                <option selected disabled hidden>None</option>
                <?php 
                    for($i=0;$i<count($country);$i++)
                    {
                        echo '<option>'.$country[$i]['country'].'</option>';
                    }
                ?>
            </select>
        </div></label>
        <!-- &nbsp;
        &nbsp; -->
     


        <!-- city -->
        <label for="city">City
        <select id="city" onchange="cityAdditionFun();" class="slct">
            <option selected disabled hidden>None</option>
            <?php 
                for($i=0;$i<count($city);$i++)
                {
                    echo '<option>'.$city[$i]['city'].'</option>';
                }
            ?>
        </select></label>
        <!-- &nbsp;
        &nbsp; -->
        <input style="border: 0px; padding: 20px; margin:10px;width: 110px;background-color:rgb(146, 190, 255);color:rgb(255, 255, 255);border-radius: 10px;font-size: 15px;" type="reset" onclick="resetFun()"/>
        
    </form>
    <div class="filtersClass">
        <h2>Filters Area</h2>
        <p style="text-align:center; color: green;" id="countDataEntries"></p>
        <label>End Year: </label><p style="display: inline-block;" id="selectedEndYear" class="slcthover"></p><br>
        <label>Topics: </label><p style="display: inline-block" id="selectedTopic" class="slcthover"></p><br>
        <label>Region: </label><p style="display: inline-block" id="selectedRegion" class="slcthover"></p><br>
        <label>Pestle: </label><p style="display: inline-block" id="selectedPestle" class="slcthover"></p><br>
        <label>Source: </label><p style="display: inline-block" id="selectedSource" class="slcthover"></p><br>
        <label>Swot: </label><p style="display: inline-block" id="selectedSwot" class="slcthover"></p><br>
        <label>Country: </label><p style="display: inline-block" id="selectedCountry" class="slcthover"></p><br>
        <label>City: </label><p style="display: inline-block" id="selectedCity" class="slcthover"></p><br>
        <p>**Click on the bubbles to deselect a filter! and to add a filter select from < select > tag!!**</p>
    </div>

    
    <div class="AppBox">
        <div class="intensityAppBox">
            <?php include_once("intensityApp.php");?>
        </div>
        
        
        <div class="countryAppBox">
            <?php include_once("countryApp.php");?>
        </div>

        <div class="likelihoodAppBox" >
            <?php include_once("likelihoodApp.php");?>
        </div>

        <div class="relevanceAppBox">
            <?php include_once("relevanceApp.php");?>
        </div>

        <!-- <div class="topicAppBox">
            <?php include_once("topicApp.php");?>
        </div> -->

        <div class="regionAppBox">
            <?php include_once("regionApp.php");?>
        </div>

        <div class="cityAppBox">
            <?php include_once("cityApp.php");?>
        </div>

<div class="indChart" style="text-align:center;">
<hr>
		<h1>These are Individual Chart</h1>
		<h6>For comparing values (click on checkboxes)</h6>
	    </div>
	
		<div class="intensityChartBox"> 
			<?php include("intensityChart.php");?>
		</div>
		
		
		<div class="relevanceChartBox">
			<?php include("relevanceChart.php");?>
		</div>

        <div class="sectorChartBox">
			<?php include("sectorChart.php");?>
		</div>


		<div class="pestleChartBox"> 
			<?php include("pestleChart.php");?>
		</div>
		
		<div class="regionChartBox">
			<?php include("regionChart.php");?>
		</div>

        

    </div>
</div>