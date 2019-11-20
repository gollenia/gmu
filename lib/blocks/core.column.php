<?php
function core_column_render( $attributes, $content ) {
    $content = preg_replace("/wp-block-column/", 'col-lg', $content, 1);
    return $content;
  }