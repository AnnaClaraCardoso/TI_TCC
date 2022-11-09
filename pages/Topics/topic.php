<?php
  $id = !empty($_GET['id']) ? $_GET['id'] : null;
  $title = !empty($_GET['titulo']) ? $_GET['titulo'] : '';
  
  include_once('../../dbConfig.php');
  $sql = "SELECT * FROM temas WHERE id = $id";
  $result = mysqli_query($conexao, $sql);

  if ($result->num_rows > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $banner_path = $row['banner_path'];
      $material_path = $row['material_path'];
      $nome_pdf = $row['nome_pdf'];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../../styles/global.css">

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/decoupled-document/ckeditor.js"></script>

  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100%;
    }

    .topic-header {
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      height: 280px;
      width: 100%;
    }

    .topic-title {
      display: flex;
      width: 100%;
      height: 280px;
      background-color: rgba(0, 0, 0, 0.35);
      padding: 0.5rem 1rem;
      color: #fff;
      justify-content: center;
      align-items: center;
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

    main {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>
  
  <title> <?php echo $title?> </title>
</head>
<body>
  <?php
    include_once('../../components/navbar.php');
  ?>
  <header style="background-image: url('<?php echo $banner_path ?>');" class="topic-header">
    <div class="topic-title">
      <h1> <?php echo $title?> </h1>
    </div>
  </header>
  <div class="container">
    <main style="height: 100vh;">
      <h2>Textos de apoio</h2>
      <object type="application/pdf" width="100%" height="80%" data="<?php echo $material_path ?>"></object>
      <div class="document-editor">
        <div class="document-editor__toolbar"></div>
        <div class="document-editor__editable-container">
          <div class="document-editor__editable">
              <p>The initial editor data.</p>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script>
    DecoupledEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
        } )
        .catch( error => {
            console.error( error );
        } );
  </script>
</body>
</html>