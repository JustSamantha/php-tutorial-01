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