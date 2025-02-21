<?php require_once('../../../private/initialize.php'); ?>

<?php
  $id = $_GET['id'] ?? '1'; // PHP > 7.0

  $subject = find_subject_by_id($id);
?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">
    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dt><?php echo h($subject['menu_name']); ?></dt>
      </dl>
      <dl>
        <dt>Position</dt>
        <dt><?php echo h($subject['position']); ?></dt>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dt><?php echo h($subject['visible']); ?></dt>
      </dl>
    </div>
  </div>

</div>
