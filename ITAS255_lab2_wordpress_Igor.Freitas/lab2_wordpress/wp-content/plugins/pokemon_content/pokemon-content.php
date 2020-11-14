<?php
/**
 * Plugin Name: Gallery In every Post
 * Description: Forces the gallery shortcode on every post so it displays images
 * Version:     0.1
 * Authoer:     ifreitas
 */

// security measure to prevent people from running this script directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function post_shortcode( $content ) {
    global $post;
    if( ! $post instanceof WP_Post ) return $content;
  
    switch( $post->post_type ) {
      case 'post':
        return $content . '[post_gallery]My content[/post_gallery]';
  
      case 'page':
        return $content . '[post_gallery]My content[/post_gallery]';
  
      default:
        return $content;
    }
  }
  
  add_filter( 'the_content', 'post_shortcode' );
  ?>
