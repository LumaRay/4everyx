<?php
Class Module
{
    var $name;
    var $id;
    var $wrap;
    
    function Module() {
        $this->name = "";
        $this->id = "0";
        $this->wrap = "true";
    }
    
    function execute() {
        global $yx_database, $yx_form, $yx_session, $yx_elements;

        $yx_module_name = $this->name;

        $yx_module_id = $this->id;

        $yx_module_wrap = $this->wrap;
    
        $yx_module_php_path = yx_get_module_php_path($this->name);

        $yx_module_full_id = yx_get_module_full_id($this->name, $this->id);
                
        if ($this->wrap == "true") echo "<div name='$this->name' id='$yx_module_full_id'>";
        require($yx_module_php_path);
        if ($this->wrap == "true") echo "</div>";

        if ($this->wrap == "true") $this->insertStyle();//require( 'styles.php' );
    }
    
    function insertStyle() {
        global $yx_database, $yx_form, $yx_session, $yx_elements;

        $yx_module_css_path = yx_get_module_css_path($this->name);

        if ( file_exists( $yx_module_css_path ) ) {
            $css = file_get_contents( $yx_module_css_path );
            $css = str_replace("this", yx_get_module_full_id($this->name, $this->id), $css);
            echo "<style type='text/css'>$css</style>";
        } //else {echo "module: $yx_module_name wrong path: ". $yx_module_css_path;}
    }
}
?>