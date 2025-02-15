<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = 'View Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<a href="<?php echo url_for('/staff/subjects'); ?>"><< Back To List</a>

<br />

<?php
  $id = $_GET['id'] ?? '1'; // PHP < 7.0

  echo h($id);
?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>