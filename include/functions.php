<?php
    function yx_clean_str($value)
    {//echo $value;
        // Stripslashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
            if (!is_numeric($value)) {
                //$value = "'" . mysql_real_escape_string($value) . "'";
                $value = mysql_real_escape_string($value);
            }//echo $value;
        }
        // Quote if not integer
        return $value;
    }
    
    function yx_get_module_subname($module_name) {
        $out=preg_split('/\./',trim($module_name));  
        return $out[count($out)-1]; 
    }

    function yx_get_module_www_path($module_name) {
        return "modules/" . str_replace(".", "/", $module_name) . "/";
    }
    
    function yx_get_module_path($module_name) {
        return YX_SITE_ROOT . "modules/" . str_replace(".", "/", $module_name) . "/";
    }
    
    function yx_get_module_php_path($module_name) {
        return yx_get_module_path($module_name) . yx_get_module_subname($module_name) . ".php";
    }
    
    function yx_get_module_css_path($module_name) {
        return yx_get_module_path($module_name) . yx_get_module_subname($module_name) . ".css";
    }
    
    function yx_get_module_full_id($module_name, $instance_id) {
        return str_replace(".", "-", $module_name) . "-" . $instance_id;
    }
    
    function yx_insert_header_common_block() {
        echo "<title></title>";
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        echo "<script type='text/javascript' src='javascript/jquery/jquery.js'></script>";
    }
    
    function yx_insert_header_link_to_module_style($module_name) {
        echo "<link type='text/css' rel='stylesheet' href='styles.php?module=$module_name'>";
    }
    
    /*
    function yx_insert($module_name, $id = 0) {
        $_GET["module"] = $module_name;
        $_GET["id"] = $id;
        echo "<div name='$module_name' id='$module_name.$id'>";
        require_once( 'execute.php' );
        echo "</div>";
    }
    */
    function yx_insert_inline($module_name, $instance_id = 0, $wrap = true) {
        $_GET["module"] = $module_name;
        $_GET["id"] = $instance_id;
        $_GET["wrap"] = $wrap?"true":"false";
        
        require( 'modules.php' );
    }
    
    function yx_insert_ajax($module_name, $instance_id = 0, $wrap = true, $effect = "") {
        global $appearEffects;
        
        $_GET["module"] = $module_name;
        $_GET["id"] = $instance_id;

        $module_full_id = yx_get_module_full_id($module_name, $instance_id);

        if ($wrap === true) {
            if ($effect != "") {
                echo "<div name='$module_name' id='$module_full_id' style='display: none;'></div>";
                echo "<script type='text/javascript'>jQuery('#$module_full_id').load('modules.php?module=$module_name&id=$instance_id', function () { ".$appearEffects[$effect]."});</script>";
            } else {
                echo "<div name='$module_name' id='$module_full_id'></div>";
                echo "<script type='text/javascript'>jQuery('#$module_full_id').load('modules.php?module=$module_name&id=$instance_id');</script>";
            }
            
            require( 'styles.php' );
            
        } else {
            echo "<script type='text/javascript'>jQuery.ajax({type: 'GET', url: 'modules.php', data: 'module=$module_name&id=$instance_id', success: function(msg){ document.write(msg); }});</script>";
        }
    }
?>