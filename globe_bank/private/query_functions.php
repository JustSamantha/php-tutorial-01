<?php
  
  /**
   * Validates the subject data from an associate array
   * @param  Array $subject Associate array containing menu_name,
   *                        position and visible fields
   * @return Array An array of error or empty array on success
   */
  function validate_subject($subject) {
    $errors = [];
    
    // menu_name
    if(is_blank($subject['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $subject['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    return $errors;
  }

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
    $sql .= "WHERE id = '".$id."';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
  }

  /**
   * Inserts a subject into database
   * @param  Array $subject The array with menu_name, position and visible
   * @return boolean True on success, exits on error
   */
  function insert_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO subjects(menu_name, position, visible) ";
    $sql .= "VALUES('".$subject['menu_name']."', '".$subject['position']."', '".$subject['visible']."');";
    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Updates a subject into database
   * @param  Array $subject The array with id, menu_name, position and visible
   * @return boolean True on success, exits on error
   */
  function update_subject($subject) {
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='".$subject['menu_name']."', position='".$subject['position']."', visible='".$subject['visible']."' ";
    $sql .= "WHERE id = '".$subject['id']."' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Deletes a subject from database based on the id
   * @param  mixed $id The id of the subject to delete
   * @return boolean True on success, exits on error
   */
  function delete_subject($id) {
    global $db;

    $sql = "DELETE FROM subjects WHERE id = '".$id."' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Finds the subject's max position to display the dropdown
   * @return integer The max position found
   */
  function find_max_subjects_position() {
    global $db;

    $sql = "SELECT MAX(position) as max FROM subjects;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $max_position = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $max_position['max'];
  }

  /**
   * Validates the page data from an associate array
   * @param  Array $page Associate array containing menu_name,
   *                        subject_id, position, visible and content fields
   * @return Array An array of error or empty array on success
   */
  function validate_page($page) {
    $errors = [];
    $page_id = $page['id'] ?? 0;
    
    // menu_name
    if(is_blank($page['menu_name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }
    $page_menu_name_unique = has_unique_page_menu_name($page['menu_name'], $page_id);
    if (!$page_menu_name_unique) {
      $errors[] = "Menu name exists in database";
    }

    // subject_id
    // Make sure we are working with an integer
    $postion_int = (int) $page['subject_id'];
    if($postion_int <= 0) {
      $errors[] = "Subject needs a selection";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int) $page['position'];
    if($postion_int <= 0) {
      $errors[] = "Position must be greater than zero.";
    }
    if($postion_int > 999) {
      $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
      $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
      $errors[] = "Content cannot be blank.";
    }

    return $errors;
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
   * Gets the page with the provided id from database
   * @param  integer $id The id to fetch from database
   * @return array The data found or empty
   */
  function find_page_by_id($id) {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id = '".$id."';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $page;
  }

  /**
   * Gets the page with the provided menu_name from database
   * @param  integer $menu_name The menu_name to fetch from database
   * @return array The data found or empty
   */
  function find_page_by_menu_name($menu_name) {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name = '".$menu_name."';";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $page;
  }

  function has_unique_page_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name = '".$menu_name."' ";
    $sql .= "AND id != '".$current_id."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $num_rows = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $num_rows === 0;
  }

  /**
   * Inserts a page into database
   * @param  Array $page The array with subject_id, menu_name, position, visible and content
   * @return boolean True on success, exits on error
   */
  function insert_page($page) {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO pages(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES('".$page['subject_id']."', '".$page['menu_name']."', ";
    $sql .= "'".$page['position']."', '".$page['visible']."', '".$page['content']."');";

    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Updates a page into database
   * @param  Array $page The array with id, subject_id, menu_name, position, visible and content
   * @return boolean True on success, exits on error
   */
  function update_page($page) {
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='".$page['subject_id']."', menu_name='".$page['menu_name']."', ";
    $sql .= "position='".$page['position']."', visible='".$page['visible']."', content='".$page['content']."' ";
    $sql .= "WHERE id = '".$page['id']."' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Deletes a page from database based on the id
   * @param  mixed $id The id of the page to delete
   * @return boolean True on success, exits on error
   */
  function delete_page($id) {
    global $db;

    $sql = "DELETE FROM pages WHERE id = '".$id."' LIMIT 1;";
    $result = mysqli_query($db, $sql);
    confirm_db_operation($result);

    return $result;
  }
  
  /**
   * Finds the pages's max position to display the dropdown
   * @return integer The max position found
   */
  function find_max_pages_position() {
    global $db;

    $sql = "SELECT MAX(position) as max FROM pages;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    $max_position = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $max_position['max'];
  }
?>