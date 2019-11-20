<?php

function camp_shortcode( $atts ) {
   $attributes = shortcode_atts( array(
      'id' => 0,
      'limit' => 10
   ), $atts );



   if (class_exists('EM_Events')) {
       $hollidays = EM_Events::get(array('limit'=>1,'orderby'=>'date', 'category' => 'freizeit'));
   }

   $camps = array();

   foreach ($hollidays as $key => $value) {
     $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'large' );

     if (class_exists('EM_Locations')){
        $location = EM_Locations::get( array('location' => $value->location_id) );
     }
     $camp = array(
       'title' => $value->post_title,
       'start' => $value->start,
       'guid' => $value->guid,
       'end' => $value->end,
       'leader' => $value->event_attributes['Referent'],
       'image' => new Timber\Image($image[0]),
       'location' => $location[0]->post_title,
       'details' => $value->post_excerpt,
     );
     
     array_push($camps, $camp);
   }


   
   return Timber::compile( array( 'shortcodes/camps.twig'), array('camps' => $camps));
}