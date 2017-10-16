<?php 
function slugify($text)
{
$text = str_replace(' ', '_', $text);
$text = trim($text, '_');



  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
