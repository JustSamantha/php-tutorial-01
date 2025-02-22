<?php
  
  require_once('../../../private/initialize.php');

  $message = '';

  if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '0';
    $checked = ($_POST['visible']) ? 'checked' : '';
  
    insert_page($_POST);

    $message = 'Page successfully created';
  }
  $max_position = find_max_pages_position();
  $subjects = find_all_subjects();
?>
<?php $page_title = 'New Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>New Page</h1>

    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" /></dd>
      </dl>
      <dl>
        <dt>Subject:</dt>
        <dd>
          <select name="subject_id">
            <?php
              while ($subject = mysqli_fetch_assoc($subjects)) {
                echo '<option value="' . $subject['id'] . '">' . $subject['menu_name'] . '</option>';
              }
            ?>
          </select>
        </dd>
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
      <dl>
        <dt>Content</dt>
        <dd><textarea name="content" cols="60" rows="10"></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="New Page" />
      </div>
    </form>

    <div><?php echo $message; ?></div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
