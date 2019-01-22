<?php
require_once("./init.php");

$yx_module = new Module;
$yx_module->name = $_GET["module"];
$yx_module->id = $_GET["id"];
$yx_module->wrap = $_GET["wrap"];

$yx_module->execute();

require_once("./deinit.php");
?>