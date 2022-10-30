<?php
  // Inicia sessões
  if (!isset($_SESSION)) session_start();

  // Verifica se existe os dados da sessão de login
  if(!isset($_SESSION['user']) && !is_array($_SESSION['user'])) header("Location: ../index.php");
  else {
    // Usuário logado!
    $id = $_SESSION['user']['id'];
    $email = $_SESSION['user']['user-name'];
    $perfil = $_SESSION['user']['access-level'];
  }
?>