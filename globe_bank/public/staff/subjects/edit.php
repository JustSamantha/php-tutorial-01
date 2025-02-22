<?php
  
  require_once('../../../private/initialize.php');

  if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
  }

  $id = $_GET['id'];
  $message = '';

  if (is_post_request()) {
    // Handle form values sent by new.php
  
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';
    $_POST['id'] = $id;

    update_subject($_POST);

    $message = 'Subject successfully updated';
  }
  $max_position = find_max_subject_position();
  $subject = find_subject_by_id($id);
?>
<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Subject</h1>

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

    <div><?php echo $message; ?></div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
