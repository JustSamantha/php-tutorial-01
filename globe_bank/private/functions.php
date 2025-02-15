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

?>
