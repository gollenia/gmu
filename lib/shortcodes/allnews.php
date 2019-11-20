<?php

function allnews_shortcode( $atts ) {
    $a = shortcode_atts( array(
       'title' => "News",
       'limit' => 4,
       'cols' => '3'
    ), $atts );
 
    $news = array();
 
     $recent_posts = wp_get_recent_posts( array(  ) );
    
    foreach ($recent_posts as $key => $post) {
       $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post['ID'] ), 'large' );
       $article = array(
          'title' => $post['post_title'],
          'date' => $post['post_date'],
          'category' => get_the_terms( $post['ID'], 'category' ), 
          'url' => $post['guid'],
          'author' => array( 
             'name' => get_the_author_meta( 'display_name', $post['post_author']),
             'mail' => get_the_author_meta( 'user_email', $post['post_author'])
          ),
          'image' => new Timber\Image($image[0]),
          'excerpt' => $post['post_excerpt']
       );
       
       
       array_push($news, $article);
       
     }
     
     return Timber::compile( array( 'shortcodes/allnews.twig'), array('news' => $news, 'cols' => $a['cols']));
 }