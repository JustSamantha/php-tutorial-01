<?php
    
  /**
   * Gets all subjects from database
   * @return Array The subjects found on database
   */
  function find_all_subjects() {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "ORDER BY position ASC;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }
  
  /**
   * Gets the subject with the provided id from database
   * @param  integer $id The id to fetch from database
   * @return array The data found or empty
   */
  function find_subject_by_id($id) {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id = '".$id."' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
  }

  /**
   * Gets all pages from database
   * @return Array The pages found on database
   */
  function find_all_pages() {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
  }
  
  /**
   * Inserts a subject into database
   * @param  string $menu_name menu_name field
   * @param  integer $position position field
   * @param  integer $visible visible field
   * @return boolean True on success
   */
  function insert_subject($menu_name, $position, $visible) {
    global $db;

    $sql = "INSERT INTO subjects(menu_name, position, visible) ";
    $sql .= "VALUES('".$menu_name."', '".$position."', '".$visible."');";
    $result = mysqli_query($db, $sql);
    confirm_insert($result);

    return $result;
  }
  
  /**
   * Finds the subject's max position to display the dropdown
   * @return integer The max position found
   */
  function find_max_subject_position() {
    global $db;

    $sql = "SELECT MAX(position) as max FROM subjects ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $max_position = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $max_position['max'];
  }
?>