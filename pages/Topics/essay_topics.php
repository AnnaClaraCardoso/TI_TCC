<?php
  include_once('../../dbConfig.php');
  $sql = "SELECT * FROM temas ORDER BY id DESC";
  $result = $conexao->query($sql);
?>
<DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Temas para Redações</title>

  <link rel="stylesheet" href="../../styles/global.css">

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <style>
    .container {
      flex-direction: column;
    }

    #topics-list {
      margin-top: 1rem;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); 
      width: 90vw;
      grid-gap: 15px;
    }

    .card {
      width: 100%;
      transition: 0.15s;
    }

    .card:hover {
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
      outline: 3px solid cornflowerblue;
    }

    input[type=file] {
      border: none;
    }
    
    #picture-input {
    display: none;
    }

    .picture {
    width: 400px;
    aspect-ratio: 16/9;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aaa;
    border: 2px dashed currentcolor;
    cursor: pointer;
    font-family: sans-serif;
    transition: color 300ms ease-in-out, background 300ms ease-in-out;
    outline: none;
    overflow: hidden;
    }

    .picture:hover {
    color: #777;
    background: #ccc;
    }

    .picture:active {
    border-color: turquoise;
    color: turquoise;
    background: #eee;
    }

    .picture:focus {
    color: #777;
    background: #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .picture-img {
      max-width: 100%;
    }

    .card-header {
      background-repeat: no-repeat;
      background-position: center;
      background-size: 100%;
      height: 180px;
      padding: 0;
      border-radius: 0.375rem !important;
    }

    .card-body {
      border-radius: 0.375rem;
    }

    .card-title {
      display: flex;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.35);
      padding: 0.5rem 1rem;
      color: #fff;
      justify-content: center;
      align-items: center;
      border-radius: 0.375rem;
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      padding: 0.5rem 1rem;
      height: 100%;
      align-items: center;
      transition: 0.3s;
    }

    .nav-links a:hover {
      color: rgb(3, 41, 166);
    }
  </style>

  <link rel="stylesheet" href="../../styles/global.css">
</head>
<body>
  <?php
    include_once('../../components/navbar.php');
  ?>
  
  <div class="container">

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="topic-form" enctype="multipart/form-data" method="POST">
              <input type="text" name="operation" hidden value="">
              <div class="topic-title-input-group">
                <input type="text" id="topic-title" name="topic-title" value="" placeholder="Descrição do tema">
              </div>
              <div class="banner-input-group">
                <label for="picture-input" class="form-label picture">
                  <span class="picture-image"></span>
                </label>
                <input type="file" name="picture-input" id="picture-input">
                <span id="img-input-help-text"></span>
              </div>
              <div class="pdf_file-input-group">
                <label for="pdf-input" class="form-label">Adicione o arquivo com orientações para a produção textual</label>
                <input type="file" name="pdf-input" id="pdf-input">
                <span id="img-input-help-text"></span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <h1>Temas para Redações</h1>
    <div class="row">
      <?php
        if($perfil == 2) {
          echo '
            <div class="col-12">
              <span id="help-text"></span>
              <button id="new-topic-btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Adicionar tema
              </button>
            </div>
          ';
        }
      ?>
      <div class="col-12" id="topics-list">  <!-- adicionar template-column -->
        <?php
          while($topic_data = mysqli_fetch_assoc($result)) {
            echo "
              <div class=\"card\">
                <div class=\"card-header\" id=\"$topic_data[id]\" style=\"background-image: url('".$topic_data['banner_path']."');\">
                  <div class=\"card-title\">
                    <h2>".$topic_data['titulo']."</h2>
                  </div>
                </div>";
              if($perfil == 2) {
                echo "
                  <div class=\"card-body\">
                    <a href=\"./getTopic.php?id=$topic_data[id]\" class=\"btn btn-sm btn-primary edit-btn\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                      </svg>
                    </a>
                    <a href=\"./delete.php?id=$topic_data[id]\" class=\"btn btn-sm btn-danger delete-btn\">
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                      </svg>
                    </a>
                  </div>";
              }
            echo "</div>";
          }
        ?>
      </div>
    </div>
  </div>

  <script src="./main.js"></script>
</body>
</html>