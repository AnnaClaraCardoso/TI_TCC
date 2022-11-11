<?php
  $editor_data = isset($_POST['content']) ? $_POST['content'] : "";

  $sql = "INSERT INTO essays (content) VALUES ('$editor_data')";
?>