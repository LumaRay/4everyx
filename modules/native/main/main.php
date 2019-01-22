<?php
if ( !defined('ABSPATH') )
	define('ABSPATH', $_SERVER['SCRIPT_NAME'] . '/');
?>
<html>
<head>
<?php yx_insert_header_common_block(); ?>
<?php yx_insert_header_link_to_module_style($yx_module_name); ?>
<script src="javascript/ruzee/shadedborder.js" type="text/javascript"></script>
<script type="text/javascript">
  var ruzee_border = RUZEE.ShadedBorder.create({ corner:10, shadow:0, border:1 });
</script>
</head>
<body>
<div id="left_column">
<?php yx_insert_inline("native.login"); ?>
<?php yx_insert_inline("native.navtree"); ?>
</div> <!-- #left_column -->
<div id="main_frame">
<?php yx_insert_ajax("native.welcome", 0, true, "animate"); ?>
</div> <!-- #main_frame -->
<script type="text/javascript">
  ruzee_border.render('left_column');
  ruzee_border.render('native-login-0');
  ruzee_border.render('native-navtree-0');
  ruzee_border.render('main_frame');
</script>
</body>
</html>