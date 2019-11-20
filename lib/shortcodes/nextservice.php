<?php

function nextservice_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'title' => "Termine"
   ), $atts );
   $service = EM_Events::get( array('limit'=>1,'orderby'=>'event_start_date', 'category' => 'gottesdienst') );

   $data = array(
     'start' => $service[0]->start,
     'details' => $service[0]->post_excerpt
   );

   return Timber::compile( array( 'shortcodes/nextservice.twig'), $data );
}
