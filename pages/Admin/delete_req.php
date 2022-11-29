<?php
  require_once('../../Config/connection.php');
  $essay = isset($_GET['id']) ? $_GET['id'] : null;
  $sqlDeleteEssay = "DELETE FROM redacoes WHERE id = '$essay'";
  if($connection->query($sqlDeleteEssay)) header("Location: ./requisitions.php");
?>