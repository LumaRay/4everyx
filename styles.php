<?php
require_once("./init.php");

global $yx_database, $yx_form, $yx_session, $yx_elements;

$yx_module_name = $_GET["module"];
$yx_module_id = $_GET["id"];

$yx_module_css_path = yx_get_module_css_path($yx_module_name);

if ( file_exists( $yx_module_css_path ) ) {
    $css = file_get_contents( $yx_module_css_path );
    $css = str_replace("this", yx_get_module_full_id($yx_module_name, $yx_module_id), $css);
    echo $css;
} //else {echo "module: $yx_module_name wrong path: ". $yx_module_css_path;}


require_once("./deinit.php");
?>