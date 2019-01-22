<h1>Comments</h1>
<?php
  for ($i = 0; $i < 16; $i++) {
      yx_insert_ajax("native.comments.comment", $i, true, "animate");
  }
?>
