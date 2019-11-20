<?php

function latestnews_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'title' => "News",
      'limit' => 4,
      'more' => '',
      'cols' => '2'
   ), $atts );

	 $recent_posts = wp_get_recent_posts( array( 'numberposts' => $a['limit'] ) );
    $images = array();
    
    foreach ($recent_posts as $key => $value) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value['ID'] ), 'large' );
      
      array_push($images, new Timber\Image($image[0]));
    }
   //var_dump($service[0]);
   return Timber::compile( array( 'shortcodes/latestnews.twig'), array('images' => $images, 'news' => $recent_posts, 'cols' => $a['cols'], 'more' => $a['more']));
}