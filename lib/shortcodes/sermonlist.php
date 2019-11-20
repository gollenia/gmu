<?php

function sermonlist_shortcode( $atts ) {
   $a = shortcode_atts( array(
      'title' => "Letzte Predigt",
      'limit' => 3,
      'short' => true
   ), $atts );

   $sermons = array();
   $series = get_terms( 'wpfc_sermon_series' ); 
   $query = new WP_Query(array( 'limit' => $a['limit'], 'post_type' => 'wpfc_sermon', 'post_status' => 'publish'));
   $posts = $query->posts;
   
   foreach($posts as $post) {
      $sermon = array();
      $meta = get_post_meta( $post->ID );
      $preacher = get_the_terms( $post->ID, 'wpfc_preacher' ); 
      $serie = get_the_terms( $post->ID, 'wpfc_sermon_series' ); 
      $sermon['title'] = $post->post_title;
      $sermon['date'] = $meta['sermon_date'][0];
      $sermon['bible'] = $meta->bible_passage;
      $sermon['audio'] = $meta['sermon_audio'][0];
      $sermon['duration'] = $meta['_wpfc_sermon_duration'][0];
      $sermon['preacher'] = $preacher[0]->name;
      $sermon['serie'] = array( name => $serie[0]->name, id =>  $serie[0]->name);
      // Do your stuff, e.g.
      // echo $post->post_name;
      
      array_push($sermons, $sermon);
      
  }
  
  return Timber::compile( array( 'shortcodes/sermonlist.twig'), array('sermons' => $sermons, 'series' => $series));
}  