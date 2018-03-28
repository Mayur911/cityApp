<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Atlas</title>
  
  
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,700'>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="../weather/Weather/css/index">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../weather/Weather/css/weather-icons.min.css">
	<link rel="stylesheet" href="../weather/Weather/SurfReport/css/select-css.css">
	<link rel="stylesheet" href="../weather/Weather/css/weather-icons.css">
	<link rel="stylesheet" href="../weather/Weather/css/weather-icons-wind.css">
  
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "atlas";
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM cities where id=".$_GET["city_id"]." and is_active=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}
?>
<body>
  <div class="container"> 
<section id="fancyTabWidget" class="tabs t-tabs">
        <ul class="nav nav-tabs fancyTabs" role="tablist">
        
                    <li class="tab fancyTab active">
                    <div class="arrow-down"><div class="arrow-down-inner"></div></div>	
                        <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-history"></span><span class="hidden-xs">History</span></a>
                    	<div class="whiteBlock"></div>
                    </li>
                    
                    <li class="tab fancyTab">
                    <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                        <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-cloud"></span><span class="hidden-xs">Weather</span></a>
                        <div class="whiteBlock"></div>
                    </li>
                    
                    <li class="tab fancyTab">
                    <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                        <a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-location-arrow"></span><span class="hidden-xs">New Openings</span></a>
                        <div class="whiteBlock"></div>
                    </li>
                         
                    <li class="tab fancyTab">
                    <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                        <a id="tab4" href="#tabBody4" role="tab" aria-controls="tabBody4" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-camera-retro"></span><span class="hidden-xs">Attractions</span></a>
                        <div class="whiteBlock"></div>
                    </li>
                    
                    <li class="tab fancyTab">
                    <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                        <a id="tab5" href="#tabBody5" role="tab" aria-controls="tabBody5" aria-selected="true" data-toggle="tab" tabindex="0"><span class="fa fa-leaf"></span><span class="hidden-xs">Culture</span></a>
                        <div class="whiteBlock"></div>
                    </li>
        </ul>
        <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
                    <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                        <div>
                        	<div class="row">
                                <img src="../assets/history.jpg" style="margin-left:10%;margin-right:auto; height:500px;width:80%" alt="history image">
                                <?php
                                    echo '<div class="col-md-12">
                        			<h2>'.$row["name"].'</h2>
                                    <p>'.$row["history"].'</p>
                                </div>'
                                ?>                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                        <div class="row">
                            	
                                <div class="col-md-12">
    <div class="body_over">
	</div>
	<div class="cont body" style="width: 95%; margin-left:auto;margin-right: auto;">
		<div class="innerwrap">
			<h1 id = "city-name"></h1>
			<h3 id = "date_time"></h3>
			<br>
			<span class="" id ="icon-glyph" style="font-size: 100px; margin-top:50px"> | <span id="temperature" style="font-family: 'Comic Sans MS', cursive, sans-serif"> </span></span> <br> <br>
			<span id="condition" style="font-family: 'Comic Sans MS', cursive, sans-serif;font-size: 40px;margin:55px"></span>
			<div id="demo"></div>
			<div>
				<table id ="ul_list">
					<tr>
						<th class="list_element">Wind </th>
						<th class="list_element">Atmosphere </th>
						<th class="list_element">Astronomy</th>
					</tr>
					<tr>
						<td style="text-align: center;" id="Wind"></td>
						<td style="text-align: center;" id="Atmosphere"></td>
						<td style="text-align: center;" id="Astronomy"></td>
					</tr>
				</table>
</div>
		</div>
	</div>
	<script>
    <?php
        echo "var city_name = '".$row["name"].", India';";
    ?>
    console.log(city_name);
	function addDOM (city_name) {
		$.get("https://query.yahooapis.com/v1/public/yql?q=select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='"+city_name+"')&format=json", function(data, status){
			var data_used = data.query.results.channel;
			console.log(data_used);
			$('#city-name').text(data_used.location.city);
			$('#temperature').text(data_used.item.condition.temp + " F");
			$('#condition').text(data_used.item.condition.text);
			$('#date_time').text(data_used.item.condition.date);
			$('#Wind').html("Chill "+data_used.wind.chill+" F"+"<br />Speed "+data_used.wind.speed +" mph");
			$('#Atmosphere').html("Humidity " + data_used.atmosphere.humidity+"<br /> Pressure "+ data_used.atmosphere.pressure);
			$('#Astronomy').html("Sunrise "+data_used.astronomy.sunrise +"<br />Sunset "+ data_used.astronomy.sunset);
			var class_name = "wi wi-day-sunny";
			switch (data_used.item.condition.text){
					case "Sunny":
						class_name ="wi wi-day-sunny";
						break;
					case "Partly Cloudy":
						class_name = "wi wi-day-cloudy";
						break;
					case "Mostly Cloudy":
						class_name = "wi wi-day-cloudy-high";
						break;
					case "Snow Showers":
						class_name = "wi wi-day-snow";
						break;
					case "Rain":
						class_name = "wi wi-day-rain";
						break;
					case "Thunderstorms":
						class_name = "wi wi-day-thunderstorm";
						break;
					case "Cloudy":
						class_name = "wi wi-day-cloudy-high";
						break;
					default:
						break;
					}
			$('#icon-glyph').addClass(class_name);
		});
	}
	addDOM(city_name);
	$('#city_drop').change(function(){
		console.log(this.value);
		addDOM(this.value);
	})
	</script>
                                   
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                        <div class="row">
                                <div class="col-md-12">
                        			<h2>This is the content of tab three.</h2>
                                    <p>This field is a rich HTML field with a content editor like others used in Sitefinity. It accepts images, video, tables, text, etc. Street art polaroid microdosing la croix taxidermy. Jean shorts kinfolk distillery lumbersexual pinterest XOXO semiotics. Tilde meggings asymmetrical literally pork belly, heirloom food truck YOLO. Meh echo park lyft typewriter. </p>
                                  
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane  fade" id="tabBody3" role="tabpanel" aria-labelledby="tab3" aria-hidden="true" tabindex="0">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                echo "<h2>".$row["name"]."</h2>";
                                echo $row["attraction"];
                            ?>    
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane  fade" id="tabBody4" role="tabpanel" aria-labelledby="tab4" aria-hidden="true" tabindex="0">
                    <div class="row">
                        <div class="col-md-12">
                        <img src="../assets/attraction.jpg" style="margin-left:10%;margin-right:auto; height:500px;width:80%" alt="history image">
                                    <?php
                                echo "<h2>".$row["name"]."</h2>";
                                echo $row["attraction"];
                            ?>   
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane  fade" id="tabBody5" role="tabpanel" aria-labelledby="tab5" aria-hidden="true" tabindex="0">
                    <div class="row">
                        <div class="col-md-12">
                        <img src="../assets/culture.jpg" style="margin-left:10%;margin-right:auto; height:500px;width:80%" alt="history image">
                        <?php
                        echo "<h2>".$row["name"]."</h2>";
                        echo $row["culture"];
                    ?>   
                                  
                                </div>
                            </div>
                    </div>
        </div>

    </section>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
