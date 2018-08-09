<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">MyCRM</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav m-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Listing <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addClient.php">Ajouter Client</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addEntreprise.php">Ajouter Entreprise</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="container">
  <h1>Ajouter Entreprise</h1>

    <form method="post" action="addEntreprise.php">
    <div class="form-group">
      <input type="text" class="form-control" name="name" id="nomEntreprise" placeholder="Nom">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" name="adress" id="adresseEntreprise" placeholder="Adresse">
    </div>
    <button class="btn btn-secondary" type="submit" name="submit">Ajouter</button>
    </form>
</div> <!-- DIV CONTAINER -->

    <?php $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop');

    if (isset($_POST["submit"])) {
  $photo = "https://picsum.photos/200?random";
        // $entrepriseName = $_POST["name"];
        // $entrepriseAdress = $_POST["adress"];


        $lineADD = $dbh->prepare("INSERT INTO entreprise (nom ,photo , adresse) VALUES (:name, :photo, :addr)");
        $lineADD->bindParam(':name', $_POST["name"]);
        $lineADD->bindParam(':photo', $photo);
        $lineADD->bindParam(':addr', $_POST["adress"]);

         $lineADD->execute();
         header("Location: http://minicrm-php/index.php");
    }


    ?>


  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script/script.js" charset="utf-8"></script>
</body>

</html>
