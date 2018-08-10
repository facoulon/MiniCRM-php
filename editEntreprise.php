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
  <h1>Edit Entreprise</h1>
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop');
    if (isset($_POST['submit'])) {
        echo $_POST["name"];
        echo $_POST["adress"];
        echo $_POST["idEntreprise"];
            $request = $dbh->prepare("UPDATE entreprise SET nom=:name, adresse=:adress WHERE id=:id");
            $request->bindParam(':name', $_POST['name']);
            $request->bindParam(':adress', $_POST['adress']);
            $request->bindParam(':id', $_POST["idEntreprise"]);
            $request->execute();
    } else {

        $ligne = $dbh->query('SELECT * from entreprise WHERE id='.$_POST["btnEdit"])->fetch();  ?>

        <form method="post" action="editEntreprise.php">
        <div class="form-group">
          <input type="text" hidden name="idEntreprise" value="<?php echo $ligne["id"] ?>">
          <input type="text" class="form-control" value="<?php echo $ligne["nom"] ?>"  name="name"  placeholder="Nom">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" value="<?php echo $ligne["adresse"] ?>" name="adress" id="adresseEntreprise" placeholder="Adresse">
        </div>
        <button class="btn btn-secondary" type="submit" name="submit">Ajouter</button>
        </form>


    <?php } ?>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script/script.js" charset="utf-8"></script>
</body>

</html>
