<?php

function core_list_render( $attributes, $content ) {

$content = preg_replace("/<ul>/", '<ul class="styled-list">', $content, 1);
return $content;
}