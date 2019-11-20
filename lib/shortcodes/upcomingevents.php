<?php

function upcomingevents_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'title' => "Termine",
      'limit' => 4,
      'category' => false
   ), $atts );
   if (class_exists('EM_Events')) {
      if (!$a['category']) {
         $upcoming = EM_Events::get( array('limit'=>$a['limit']));
      } else {
         $upcoming = EM_Events::get( array('category' => $a['category'], 'limit' => $a['limit']));
      }
   } else { return; }
   $images = array();
   foreach ($upcoming as $key => $value) {
     $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'small' );
     array_push($images, new Timber\Image($image[0]));
   }
   
   return Timber::compile( array( 'shortcodes/upcomingevents.twig'), array('events' => $upcoming, 'title' => $a['title'], 'images' => $images));
}