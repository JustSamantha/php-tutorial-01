<?php
  
  require_once('../../../private/initialize.php');

  $message = '';

  if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '0';
    $checked = ($_POST['visible']) ? 'checked' : '';
  
    insert_subject($_POST);

    $message = 'Subject successfully created';
  }

  $max_position = find_max_subjects_position();
?>
<?php $page_title = 'New Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject create">
    <h1>New Subject</h1>

    <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for ($i=1; $i<=$max_position; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
              }
              echo '<option value="' . $i . '" selected>' . $i . '</option>';
            ?> 
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="New Subject" />
      </div>
    </form>

    <div><?php echo $message; ?></div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
