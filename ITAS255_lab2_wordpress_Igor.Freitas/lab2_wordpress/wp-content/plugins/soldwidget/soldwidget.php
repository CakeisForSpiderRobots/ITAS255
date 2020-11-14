<?php
   /*
   Plugin Name: Sold Widget
   description: >- Displays sold houses
   Version: 1.2
   Author: Igor
   License: GPL2
   */
  function sold_register_widget() {
    register_widget( 'sold_widget' );
    }
    add_action( 'widgets_init', 'sold_register_widget' );
    class sold_widget extends WP_Widget {
    function __construct() {
    parent::__construct(
    // widget ID
    'sold_widget',
    // widget name
    __('SOLD Widget', ' sold_widget_domain'),
    // widget description
    array( 'description' => __( 'Sold house widget', 'sold_widget_domain' ), )
    );
    }
    public function widget( $args, $instance ) {
        echo "Houses SOLD";
        
// The Query to show a specific Custom Field
 
$the_query = new WP_Query( array( 'meta_key' => 'sold', 'meta_value' => '1' ) );
 
// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
 
?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
endwhile;
 
// Reset Post Data
wp_reset_postdata();
 

        }

    }
   
?>