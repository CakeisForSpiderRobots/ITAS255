<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pokemon Nanaimo Map!</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <style>
    body {
			background-image: url('images/background.png');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100% 100%;
            color: white;
            text-align:center;
		}
        body text{
            display: inline-block;
            background-color:10, 10, 10;
        }
        #map{
            display: block;
            float:left;
			margin-top:10;
  			width: 50%;
        }
        table#pokemontable{
            float:left;
            background-image: url('images/pokedex.png');
            border-style: outset; 
            border-width: 5px;

        }
        table#pokemontable img{
            background-image: url("images/pokedex_Background.jpg");

        }

        table#pokemontable th{
            background-color:rgba(51, 170, 51, .4);
        }
        table#pokemontable td{
            background-color:rgba(170, 0, 51, .6);
        }

        table#pokemontable caption{
            background-color:rgba(170, 0, 51);

        }
        table#wildpokemontable{
            float:right;
            background-image: url('images/wildtable.png');
            border-style: outset; 
            border-width: 5px;

        }
        table#wildpokemontable img{
            background-image: url("images/pokedex_Background.jpg");

        }

        table#wildpokemontable th{
            background-color:rgba(51, 170, 51, .4);
        }
        table#wildpokemontable td{
            background-color:rgba(0, 200, 51, .4);
        }
        table#wildpokemontable caption{
            background-color:rgba(0, 200, 51, .8);

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    
    </script>
    <script>
        var map;
        var myMarkers = [];

        function initMap() {
            var nanaimo = {
                lat: 49.159700,
                lng: -123.907750
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: nanaimo
            });
        }

        function clearMarkers() {
            for (var i = 0; i < myMarkers.length; i++) {
                myMarkers[i].setMap(null);
            }
            myMarkers = [];
        }

        $(document).ready(function() {

            console.log("Document ready!");

            $('#reset').click(function() {

                clearMarkers();

                var url = 'getPokemon.php?reset=true';
                var data = {};
                $.getJSON(url, data, function(data, status) {
                    console.log("Back from the reset");
                    var showData = $('#show-data');
                    showData.text("Session Reset");
                });
            });

            $('#get-data').click(function() {
                clearMarkers();

                var showData = $('#show-data');
                showData.empty();

                var url = 'getPokemon.php';
                var data = {
                    q: 'search',
                    text: 'not implemented yet!'
                };
                console.log("Sending request for Pokemon marker list...");

                try {
                    $.getJSON(url, data, function(data, status) {
                        console.log("Ajax call completed, status is: " + status);

                        showData.text(data.message);


                        data.markers.forEach(function(marker) {

                            var myLatlng = new google.maps.LatLng(marker.lat, marker.long);

                            var myIcon = new google.maps.MarkerImage(("images/" + marker.image), null, null, null, new google.maps.Size(40, 40));

                            var mmarker = new google.maps.Marker({
                                position: myLatlng,
                                map: map,
                                title: marker.name,
                                icon: myIcon
                            });

                            myMarkers.push(mmarker);
                        });
                    })
                } catch (error) {
                    console.log("Error requesting JSON data: " + error);
                }

            });
        });
    </script>
</head>

<body>
    <div id="map" style="width: 700px; height: 500px; margin-left:550px; margin-top: 5px; border-style: outset; border-width: 15px"></div>
    <a href="#" id="get-data"><img src="images/battle.png" style="margin-left: 45%; margin-right: 50%;
         width=150" height="30" ></a>
    <br>
    <a href="#" id="reset"><img src="images/reset.png" style="margin-left: 45%; margin-right: 50%;
         width=150" height="30"></a>

    <div id="show-data"></div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIKsa3uE7a7o4o4UrtUtj0dcbQVc77K_8&callback=initMap">
    
    </script>
    <?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
function __autoload($class_name)
{
    require_once $class_name . '.php';
}
$world = World::getInstance();
$world->load();
$json = $world->getJSON();
$trainer = $world->getTrainer();
$trainer->printAll($pokedex);
$world->getWildPokemon();

?>
    


</body>

</html>