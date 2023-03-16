<?php
global $pageTitle;
?>
<!DOCTYPE html>
<html>

<head>
  <?php
  get_template_part("parts/head");
  echo loadUniqueFile($uniqueLoad);
  wp_head();
  ?>
</head>

<body>
  <!-- header -->
  <?php get_header(); ?>
  <!-- header -->

  <!-- content -->
  <?php include($CONTENT); ?>
  <!-- content -->

  <!-- footer -->
  <?php get_footer(); ?>
  <!-- footer -->

  <?php wp_footer(); ?>
</body>

</html>