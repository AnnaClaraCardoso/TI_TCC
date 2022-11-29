<?php
  require('../../Config/connection.php');

  if (!isset($_SESSION)) session_start();
  include('../../Authentication/auth.php');
  
  if(!empty($_GET['search']))
  {
    $data = $_GET['search'];
    $sql = "SELECT * FROM redacoes WHERE id LIKE '%$data%' or id_usuario LIKE '%$data%' or id_tema LIKE '%$data%' or data_envio LIKE '%$data%' or nota LIKE '%$data%' ORDER BY id DESC";
  }
  else $perfil == 2 ? $sql = "SELECT * FROM redacoes ORDER BY id DESC" : $sql = "SELECT * FROM redacoes WHERE id_usuario = '$id' ORDER BY id DESC";

  $result = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caixa de solicitações</title>

  <link rel="stylesheet" href="../../styles/global.css">
  <link rel="stylesheet" href="./styles/admin.css">
  <link rel="stylesheet" href="./styles/requisitions.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/b0095462dc.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    include('../../components/navbar.php');
  ?>

  <br><br>
  
  <div class="box-search">
    <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
    <button onclick="searchData()" class="btn btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
  </div>

  <div class="m-5">
    <h2>Caixa de solicitações</h2>
    <table class="table text-white table-bg">
      <thead>
        <tr>
          <?php
            if($perfil == 2) {
              echo '
                <th scope="col">#</th>
                <th scope="col">Estudante</th>
                <th scope="col">Tema</th>
                <th scope="col">Data de Envio</th>
                <th scope="col">Nota final</th>
                <th scope="col"><strong>Ações</strong></th>
              ';
            }
            else {
              echo '
                <th scope="col">#</th>
                <th scope="col">Tema</th>
                <th scope="col">Data de envio</th>
                <th scope="col">Correção</th>
                <th scope="col">Nota final</th>
                <th scope="col"><strong>Ações</strong></th>
              ';   
            }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
          if($perfil == 2) {
            while($essays = mysqli_fetch_assoc($result)) {

              $queryPickNames = "SELECT nome FROM usuarios WHERE id = {$essays['id_usuario']}";
              $queryPickTitles = "SELECT titulo FROM temas WHERE id = {$essays['id_tema']}";
              $resultPickNames = $connection->query($queryPickNames);
              $resultPickTitles = $connection->query($queryPickTitles);
              $names = mysqli_fetch_assoc($resultPickNames);
              $titles = mysqli_fetch_assoc($resultPickTitles);
              
              echo "<tr>";
              echo "<td>".$essays['id']."</td>";
              echo "<td>".$names['nome']."</td>";
              echo "<td>".$titles['titulo']."</td>";
              echo "<td>".$essays['data_envio']."</td>";
              echo "<td>".$essays['nota']."</td>";
              echo "<td>
                <a class='btn btn-sm btn-primary' href='copy_editor.php?id=".$essays['id']."&nome=".$names['nome']."&tema=".$titles['titulo']."'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                  </svg>
                </a>
              </td>";
              echo "</tr>";
            }
          } else {
            while($essays = mysqli_fetch_assoc($result)) {

              $queryPickNames = "SELECT nome FROM usuarios WHERE id = {$essays['id_usuario']}";
              $queryPickTitles = "SELECT titulo FROM temas WHERE id = {$essays['id_tema']}";
              $resultPickNames = $connection->query($queryPickNames);
              $resultPickTitles = $connection->query($queryPickTitles);
              $names = mysqli_fetch_assoc($resultPickNames);
              $titles = mysqli_fetch_assoc($resultPickTitles);
              
              echo "<tr>";
              echo "<td>".$essays['id']."</td>";
              echo "<td>".$titles['titulo']."</td>";
              echo "<td>".$essays['data_envio']."</td>";
              $sqlSelect = "SELECT * FROM correcoes WHERE id_redacao = {$essays['id']}";
              $resultSelect = $connection->query($sqlSelect);
              if($resultSelect->num_rows > 0) {
                echo "<td>Enviada</td>";
              } else {
                echo "<td>Em aguardo</td>";
              }
              echo "<td>".$essays['nota']."</td>";
              echo "<td>
                <a class='btn btn-sm btn-primary' href='copy_editor.php?id=".$essays['id']."&nome=".$names['nome']."&tema=".$titles['titulo']."'>
                  <i class='fa-solid fa-eye'></i>
                </a>
                <a class='btn btn-sm btn-danger' href='delete_req.php?id=".$essays['id']."'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                  </svg>
                </a>
              </td>";
              echo "</tr>";
            }
          }
        ?>
      </tbody>
    </table>
</div>
<script>
  var search = document.getElementById('pesquisar');
  search.addEventListener("keydown", function(event) { if (event.key === "Enter") searchData(); });
  function searchData() { window.location = 'requisitions.php?search='+search.value; }
</script>
</body>
</html>