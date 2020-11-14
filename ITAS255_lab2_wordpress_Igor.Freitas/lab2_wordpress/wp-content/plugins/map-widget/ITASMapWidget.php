<?php

/**
 * Basic widget to demonstrate how to get data from posts 
 * and pass this through to JavaScript to render on a map.
 * 
 * @author Dave Croft
 */
class ITASMapWidget extends WP_Widget {

	//private $mapHeight; 
	// variable to store the map height
					   // you could use the form and update functions
					   // to allow the user to set this to a custom value

	/**
	 * Refer to WP_Widget documentation for what the parameters 
	 * are to for calling parent constructor.
	 */
	public function __construct() {
		$widget_ops = array( 
				'classname' => 'ITASMapWidget',
				'description' => 'A plugin for a google map',
					);
		parent::__construct( 'ITASMapWidget', 'ITAS Map Widget', $widget_ops );	
	
	}
		
	/**
	 *  output the widget content on the front-end
	 */
	public function widget( $args, $instance ) {
		echo "Hello ITAS Map Widget!";
		//echo "<div>Here is a subset</div>";
?>

<script>

    var map;
    var myMarkers = [];

    function initMap() {
        var nanaimo = {lat: 49.159700, lng: -123.907750};
        map = new google.maps.Map(document.getElementById('itasmap'), {
            zoom: 13,
            center: nanaimo
        });

	<?php

		$post_list = get_posts( array(
   		 	'orderby'    => 'menu_order',
    		'sort_order' => 'asc'
		) );
 
		$posts = array();
 
		foreach ( $post_list as $post ) {

			$print = "ID: " . $post->ID . " Title: " . $post->post_title;

			// we have to retrieve the custom field as 'meta' data
		

			$lat = get_post_meta($post->ID, 'lat', true);
			$long = get_post_meta($post->ID, 'long', true);
			
			// check that lat and long exist for this post!
			//if ($lat != null && $long != null) {

            $print .= " Lat: [" . $lat . "] Long: [" . $long . "]";
			echo "\nconsole.log('Post info: $print')";

			echo "\nvar myLatlng = new google.maps.LatLng($lat, $long);";
			echo "\nvar marker = new google.maps.Marker({	position: myLatlng, title:'Test House'});";
			echo "\nmarker.setMap(map);";
			
		
	
		}
		?>
	}
</script>

<div id="itasmap" style="clear: both; height: 400px; width: 100%;  margin: 0 auto;"></div>
<!--
<a href="#" id="get-data"></a>
<br>
<a href="#" id="reset">Reset</a>
-->
<div id="show-data"></div>

<!-- NOTE this google map is using an ITAS Google Map key! Do not use for any of your private applications hosted live anywhere-->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB86I452N3txNiZY9hq44MM8I2Bi-B_SmM&callback=initMap">
</script>


	<?php


	// this is the end of the widget function
	}

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
			
	
	}

	// save options
	public function update( $new_instance, $old_instance ) {

	}
}

