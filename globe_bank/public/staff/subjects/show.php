<?php require_once('../../../private/initialize.php'); ?>
<?php $page_title = 'View Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php
  $id = $_GET['id'] ?? '1'; // PHP < 7.0

  echo h($id);
?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>