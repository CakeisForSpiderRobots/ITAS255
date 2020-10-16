<?php
session_start();
?>

<head>
	<title>PHPmon</title>

	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">

	<style>


.fade-in {
animation: fadeIn ease 3s;
-webkit-animation: fadeIn ease 3s;
-moz-animation: fadeIn ease 3s;
-o-animation: fadeIn ease 3s;
-ms-animation: fadeIn ease 3s;
}
@keyframes fadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-moz-keyframes fadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-webkit-keyframes fadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-o-keyframes fadeIn {
0% {opacity:0;}
100% {opacity:1;}
}

@-ms-keyframes fadeIn {
0% {opacity:0;}
100% {opacity:1;}
}
		.center {
  			display: block;
  			margin-left: auto;
  			margin-right: auto;
  			width: 50%;
			animation: fadeIn ease 3s;
			-webkit-animation: fadeIn ease 3s;
			-moz-animation: fadeIn ease 3s;
			-o-animation: fadeIn ease 3s;
			-ms-animation: fadeIn ease 3s;
		}

		#start {
  			display: block;
  			margin-left: 880;
  			margin-right: auto;
			margin-top:10;
  			width: 50%;
			animation: fadeIn ease 10s;
			-webkit-animation: fadeIn ease 10s;
			-moz-animation: fadeIn ease  10s;
			-o-animation: fadeIn ease 10s;
			-ms-animation: fadeIn ease 10s;
		}

		body {
			background-image: url('images/background.png');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100% 100%;
		}
	</style>
</head>

<body>
<audio id="my_audio" src="bg.mp3" loop="loop"></audio>
<img class="center" src="images/Title.png" alt="Italian Trulli">
<a href="map.php" id="start">
         <img src="images/start.png"
         width=150" height="70">
      </a>

	