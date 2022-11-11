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
  <!-- <link rel="stylesheet" href="./styles/editor.css"> -->
  <link rel="stylesheet" href="./styles/topic.css">

  <!-- BOOTSTRAP CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  
  <title> <?php echo $title?> </title>
  
</head>
<body>
  <?php
    // include_once('../../components/navbar.php');
    include('../../auth.php');
    $topic_id = $_GET['id'];
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
      
      <form action="submit_essay.php?<?php echo 'tema='.$topic_id.'&usuario='.$id?>" method="post">
        <textarea name="content" id="editor">
            &lt;p&gt;This is some sample content.&lt;/p&gt;
        </textarea>
        <p><input type="submit" value="Submit"></p>
      </form>
    </main>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

  <script type="module">
    import Indent from '../../node_modules/@ckeditor/ckeditor5-indent/src/indent.js';
    import IndentBlock from '../../node_modules/@ckeditor/ckeditor5-indent/src/indentblock.js';

    ClassicEditor
      .create( document.querySelector( '#editor' ), {
        plugins: [ Indent, IndentBlock ],
        toolbar: {
            items: [ 'heading', '|', 'outdent', 'indent', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo' ]
        },
        indentBlock: {
            offset: 1,
            unit: 'em'
        }
    })
    .catch( error => {
      console.error( error );
    } );
  </script>
</body>
</html>