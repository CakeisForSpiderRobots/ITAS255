<?php
   /*
   Plugin Name: Censor plugin
   description: >- Censors specific words in comments
   Version: 1.2
   Author: Igor
   License: GPL2
   */

   
  add_filter( 'pre_comment_content', 'wps_filter_comment' );
  function wps_filter_comment($comment) {
      $replace = array(
          // 'WORD TO REPLACE' => 'REPLACE WORD WITH THIS'
          'weird' => 'wonderful',
          'hate' => 'love',
          'lawsuits' => 'lies'
          
      );
      $comment = str_replace(array_keys($replace), $replace, $comment);
      return $comment;
  }
  ?>