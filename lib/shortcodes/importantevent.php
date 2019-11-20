<?php

function importantevent_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'title' => "Termine",
   ), $atts );
   if (class_exists('EM_Events')) {
       $upcoming = EM_Events::get( array('limit'=>1, 'category' => 'wichtig'));
   }
   $images = array();
   foreach ($upcoming as $key => $value) {
     $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'small' );
     array_push($images, new Timber\Image($image[0]));
   }
   
   return Timber::compile( array( 'shortcodes/importantevent.twig'), array('events' => $upcoming, 'title' => $a['title'], 'images' => $images));
}