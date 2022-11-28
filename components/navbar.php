<?php
  if (!isset($_SESSION)) session_start();
  include('../../Authentication/auth.php');
  echo "
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-primary\">
      <div class=\"container-fluid\">
        <div class=\"nav-links\">";
  if($perfil == 2) {
    echo "<a href=\"/pi_if/pages/Admin/admin.php\">Usuários</a>";
  }
  echo "
          <a href=\"/pi_if/pages/Topics/essay_topics.php\">Artigos</a>
          <a href=\"/pi_if/pages/Admin/requisitions.php\">Requisições</a>
        </div>
        <a href=\"../../logout.php\" class=\"btn btn-danger me-5\">Sair</a>
      </div>
    </nav>";
?>