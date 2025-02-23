<?php
  
  require_once('../../../private/initialize.php');

  if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
  }

  $id = $_GET['id'];
  $message = '';

  if (is_post_request()) {
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '0';
    $checked = ($_POST['visible']) ? 'checked' : '';
    $_POST['id'] = $id;
    $page = $_POST;    
  
    $result = update_page($_POST);

    if ($result === true) {
      $message = 'Page successfully updated';
    } else {
      $errors = $result;
    }
  } else {
    $page = find_page_by_id($id);
  }
  $max_position = find_max_pages_position();
  $subjects = find_all_subjects();
?>
<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page edit">
    <h1>Edit Page</h1>

    <?php
      if ($message !== '') {
        echo '<div>'.$message.'</div>';
      } elseif (count($errors) > 0) {
        echo display_errors($errors);
      }
    ?>

    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Subject:</dt>
        <dd>
          <select name="subject_id">
            <?php
              while ($subject_loop = mysqli_fetch_assoc($subjects)) {
                if ($subject_loop['id'] == $page['subject_id']) {
                  echo '<option value="' . $subject_loop['id'] . '" selected>' . $subject_loop['menu_name'] . '</option>';
                } else {
                  echo '<option value="' . $subject_loop['id'] . '">' . $subject_loop['menu_name'] . '</option>';
                }
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
                  if ($i == $page['position']) {
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
          <input type="checkbox" name="visible"<?php echo ($page['visible']) ? ' checked ' : ' '; ?>value="1" />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><textarea name="content" cols="60" rows="10"><?php echo h(($page['content']) ? $page['content'] : ''); ?></textarea></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
