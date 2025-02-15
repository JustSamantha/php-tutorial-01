<?php

/**
 * Gets the full address for the given script path
 * @param mixed $script_path The path of the file to get the full address to
 * @return string Full address of the file
 */
function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/**
 * Encodes the given URL
 * @param mixed $url URL to enconde
 * @return string Encoded URT
 */
function u($url="") {
  return urlencode($url);
}

/**
 * Raw encodes the given URL
 * @param mixed $url URL to raw enconde
 * @return string Encoded URT
 */
function raw_u($url="") {
  return rawurlencode($url);
}
?>
