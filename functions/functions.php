<?php

function replaceDummies($filename,$search,$replace) {
  $status = FALSE;
  if($filename) {
    if($data = file_get_contents($filename)){
      $data = str_replace($search, $replace, $data);
      if(file_put_contents($filename, $data)) {
        $status = TRUE;
      }
    }

  }
  return $status;
}
function showDescription($path, $folder, $file) {
  $data = array (
      "" 
  );
  $filename = $path . $folder . $file;
  if (file_exists ( $filename )) {
    $data = file ( $filename );
  }
  return join ( "<br>", $data );
}
function showXMLDescription($path, $folder, $file) {
  $filename = $path . $folder . $file;
  $xml = simplexml_load_file($filename);
  $loc = rex_i18n::getLocale();
  $code = substr($loc,0,2);
  $string = $xml->{$code};
  return $string;
}