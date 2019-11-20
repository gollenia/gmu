<?php
function eventlist_shortcode( $atts ) {
    $months = array(" ", "Jänner", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    $a = shortcode_atts( array(
       'scope' => "month",
       'limit' => "50",
    ), $atts );
    $title = "Events";
    if ($a['scope'] == 'month') {
      $title = $months[date('n')];
    }
    if ($a['scope'] == 'next-month') {
      $title = $months[date('n', strtotime('+1 month'))];
    }
 
    if (class_exists('EM_Events')) {
        $upcoming = EM_Events::get($a);
    }
 
 
    return Timber::compile( array( 'shortcodes/eventlist.twig'), array('events' => $upcoming, 'title' => $title));
 }