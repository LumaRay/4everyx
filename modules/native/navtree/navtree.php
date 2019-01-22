<ul>
<?php
  //$action = $_GET["action"];
  
  //if ($action == "get_links") {

      $parent_id = isset($_GET["parent_id"])?$_GET["parent_id"]:"0";
      
      $navs = $yx_database->query("SELECT * FROM ".YX_DB_PREFIX."module_native_navtree WHERE pid='$parent_id'");

      $itemid = str_replace(".", "-", $yx_module_name);
      
      while($row = mysql_fetch_array($navs)) {
          $subnavcnt = $yx_database->query("SELECT COUNT(*) FROM ".YX_DB_PREFIX."module_native_navtree WHERE pid='".$row["id"]."'");
          $subnavcnt = mysql_fetch_array($subnavcnt);
          $subnavcnt = $subnavcnt[0];
          
          echo "<li id='$itemid-item-".$row["id"]."'>"
          . (($subnavcnt > 0)?"<a class='toggle' href='javascript:;' ref='".$row["id"]."'>+</a>&nbsp;":"")
          . "<a class='open' href='javascript:;' ref='modules.php?module=".$row["module"]."&id=".$row["link"]."&wrap=true'>".$row["title"]."</a>"
          . "</li>";
      }
      
  //}
?>
</ul>
<script type="text/javascript">
  jQuery('div[name=<?=$yx_module_name;?>] a.toggle').unbind("click");
  jQuery('div[name=<?=$yx_module_name;?>] a.toggle').bind("click",function () {
      if (jQuery(this).text() == "+") {
          var id = jQuery(this).attr("ref");
          jQuery(this).html("-");//"&#151;");
          jQuery("<li>...подождите...</li>").insertAfter(jQuery(this).parent()).load("modules.php?module=<?=$yx_module_name;?>&parent_id="+id);
      } else {
          jQuery(this).parent().next().remove();
          jQuery(this).text("+");
      }
  });

  jQuery('div[name=<?=$yx_module_name;?>] a.open').unbind("click");
  jQuery('div[name=<?=$yx_module_name;?>] a.open').bind("click",function () {
      var req = jQuery(this).attr("ref");
      
      jQuery("#main_frame").html("<center>...подождите...</center>").load(req, function () {ruzee_border.render('main_frame');});
      //jQuery("<li>...подождите...</li>").insertAfter(jQuery(this).parent()).load("modules.php?module=native.navtree&parent_id="+id);
  });
</script>