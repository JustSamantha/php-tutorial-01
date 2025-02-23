<?php
  
  require_once('../../../private/initialize.php');

  if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
  }

  $id = $_GET['id'];
  $message = '';

  if (is_post_request()) {
    $_POST['id'] = $id;
    $subject = $_POST;

    $result = update_subject($_POST);

    if ($result === true) {
      $message = 'Subject successfully updated';
    } else {
      $errors = $result;
    }
  } else {
    $subject = find_subject_by_id($id);
  }
  $max_position = find_max_subjects_position();
?>
<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Subject</h1>

    <?php
      if ($message !== '') {
        echo '<div>'.$message.'</div>';
      } elseif (count($errors) > 0) {
        echo display_errors($errors);
      }
    ?>

    <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
                for ($i=1; $i<=$max_position; $i++) {
                  if ($i == $subject['position']) {
                    echo '<option value="' . $i . '" selected>' . $i . '</option>';
                  } else {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                  }
                }
                echo '<option value="' . $i . '">' . $i . '</option>';
              ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible"<?php echo ($subject['visible']) ? ' checked ' : ''; ?>value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
