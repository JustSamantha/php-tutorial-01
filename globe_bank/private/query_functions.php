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
?>