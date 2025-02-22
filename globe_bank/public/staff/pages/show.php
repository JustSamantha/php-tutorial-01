<?php require_once('../../../private/initialize.php'); ?>

<?php
$id = $_GET['id'] ?? '1';
$page = find_page_by_id($id);
$subject = find_subject_by_id($page['subject_id']);
?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page show">
    <h1>Page: <?php echo h($page['menu_name']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dt><?php echo h($page['menu_name']); ?></dt>
      </dl>
      <dl>
        <dt>Subject:</dt>
        <dt><?php echo h($subject['menu_name']); ?></dt>
      </dl>
      <dl>
        <dt>Position</dt>
        <dt><?php echo h($page['position']); ?></dt>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dt><?php echo h($page['visible']); ?></dt>
      </dl>
      <dl>
        <dt>Content:</dt>
        <dt><?php echo h(($page['content']) ? $page['content'] : ''); ?></dt>
      </dl>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
