<?php
  require_once('db_credentials.php');
  
  /**
   * Makes a connection to the database with the defined global variables
   * @return Connection The connection handler for the database
   */
  function db_connect() {
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $db;
  }
  
  /**
   * Disconnects the given resource from database
   * @param  Connection $connection The connection to close
   * @return void
   */
  function db_disconnect($connection) {
    if (isset($connection)) {
      mysqli_close($connection);
    }
  }
    
  /**
   * Checks the last connection attempt for errors
   * and if there is an error will output a message
   * and stop the execution.
   * @return void
   */
  function confirm_db_connect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }
  
  /**
   * Asserts if the result_set has data,
   * exits otherwise
   * @param  mixed $result_set The result set to check
   * @return void
   */
  function confirm_result_set($result_set) {
    global $db;
    
    if (!$result_set) {
      exit('Database query failed: '.mysqli_error($db));
    }
  }

  /**
   * Asserts if the insert or update query was successful, exits otherwise
   * @param  boolean $result The result of the query
   * @return void
   */
  function confirm_db_operation($result) {
    global $db;

    if (!$result) {
      exit('Query failed: '.mysqli_error($db));
    }
  }
?>