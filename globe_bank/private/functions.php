<?php

/**
 * Gets the full address for the given script path
 * @param string $script_path The path of the file to get the full address to
 * @return string Full address of the file
 */
function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = '/' . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/**
 * Encodes the given URL
 * @param string $url URL to enconde
 * @return string Encoded URT
 */
function u($url="") {
  return urlencode($url);
}

/**
 * Raw encodes the given URL
 * @param string $url URL to raw enconde
 * @return string Encoded URT
 */
function raw_u($url="") {
  return rawurlencode($url);
}

/**
 * Encodes HTML special chars
 * @param string $text Text to encode
 * @return string Encoded text
 */
function h($text= "") {
  return htmlspecialchars($text);
}

/**
 * Sends a 404 Not Found error response to the browser
 * @return never
 */
function error_404() {
  header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
  echo "<h1>404 Not Found</h1>";
  exit;
}

/**
 * Sends a 500 Internal Server Error error response to the browser
 * @return never
 */
function error_500() {
  header($_SERVER['SERVER_PROTOCOL'] . " 500 Internal Server Error");
  echo "<h1>500 Internal Server Error</h1>";
  exit;
}

/**
 * Sends a 302 Found redirect response to the browser
 * @param string $url The URL to redirect to
 * @return never
 */
function redirect_to($url) {
  header("Location: " . $url);
  exit;
}

/**
 * Returns true when the request method is POST
 * @return boolean True for POST
 */
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * Returns true when the request method is GET
 * @return boolean True for GET
 */
function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}
?>
