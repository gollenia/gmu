<?php


add_filter('timber/twig', 'add_to_twig');

function add_to_twig($twig) {
    $twig->addExtension(new Twig_Extension_StringLoader());
    $twig->addFilter(new Twig_SimpleFilter('fuzzy_date', 'fuzzyDate'));
    return $twig;
}

function fuzzyDate($ts) {
     if(!ctype_digit($ts))
         $ts = strtotime($ts);
     $weekdays = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
     $months = ['Jänner', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
     $now = time();
     $diff = round($ts-$now);
     if($diff == 0)
         return 'Jetzt gerade';
     else {
         $diff = abs($diff);
         $numMins = ($diff/60);
		$numHours = round($numMins/60);
         $numDays = round($numHours/24);
         echo $day_diff;
         if($numDays == 0)
         {
             if($diff < 120) return 'In einer Minute';
             if($diff < 3600) return 'In <span uk-countdown="date: ' . date('c', $ts) . '"><span class="uk-countdown-minutes"></span>:<span class="uk-countdown-seconds"></span></div> Minuten';
             if($diff < 7200) return 'In einer Stunde';
             if($diff < 86400) return 'Heute um ' . date('G:i', $ts) . 'Uhr';
         }
         if($numDays == 1) return 'Morgen um ' . date('G:i', $ts) . 'Uhr';
         if($numDays > 1) return $weekdays[date('w', $ts)] . ', ' . date('j', $ts) . '. ' . $months[date('n', $ts)-1] . ' um ' . date('G:i', $ts) . ' Uhr';

     }
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
