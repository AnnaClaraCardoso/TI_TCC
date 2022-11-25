<?php
  include('../../Authentication/auth.php');
  $topic_id = !empty($_GET['id']) ? $_GET['id'] : null;
  $title = !empty($_GET['titulo']) ? $_GET['titulo'] : '';
  
  include_once('../../Config/connection.php');
  $sql = "SELECT * FROM temas WHERE id = $topic_id";
  $result = mysqli_query($connection, $sql);

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
  <!-- <link rel="stylesheet" href="./styles/editor.css"> -->
  <link rel="stylesheet" href="./styles/essay.css">

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  
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
  <br><br>
  <div class="container">
    <main class="row" style="height: 100vh;">
      <object class="col-md-6" type="application/pdf" width="100%" height="80%" data="<?php echo $material_path ?>"></object>
      
      <form id="essay-form" class="col-md-6" action="insert.php?<?php echo 'tema='.$topic_id.'&usuario='.$id?>" method="post">
        <textarea name="content" id="editor">
            &lt;p&gt;Inicie aqui sua redação com base nos textos motivadores ao lado.&lt;/p&gt;
        </textarea>
        <p><input type="submit" value="Enviar para correção"></p>
      </form>
    </main>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

  <script type="module">
    ClassicEditor
    .create( document.querySelector( '#editor' ))
    .catch( error => {
      console.error( error );
    } );
  </script>
</body>
</html>