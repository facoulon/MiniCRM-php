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

<h1>AJOUT CLIENT</h1>
<form class="" action="editClient.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNom">Nom</label>
      <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom">

    </div>
    <div class="form-group col-md-6">
      <label for="inputPrenom">Prénom</label>
      <input type="text" class="form-control" name="prenom" id="inputPrenom" placeholder="Prénom">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAdresse">Addresse</label>
    <input type="text" class="form-control" id="inputAdresse" name="adresse" placeholder="1234 Main St">
  </div>
    <div class="form-group col-md-4">
      <label for="inputEntreprise">Entreprise</label>
      <select id="inputEntreprise" name="entreprise_id" class="form-control">*
        <option selected>Choix...</option>
        <?php $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop');?>
        <?php
        foreach($dbh->query('SELECT * from entreprise') as $row) : ?>
        <option value='<?php echo $row['id'] ?>'> <?php echo $row['nom'] ?></option>
      <?php endforeach; ?>
      </select>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
</form>

<?php if (isset($_POST['submit'])) {
  $lineADD = $dbh->prepare("INSERT INTO client (id ,nom , prenom, adresse, entreprise_id) VALUES (null, :nom , :prenom , :adresse, :entreprise_id )");
  $lineADD->bindParam(':nom',$_POST["nom"]);
  $lineADD->bindParam(':prenom',$_POST["prenom"]);
  $lineADD->bindParam(':adresse',$_POST["adresse"]);
  $lineADD->bindParam(':entreprise_id',$_POST["entreprise_id"]);
  $lineADD->execute();
  header("Location: http://minicrm-php/index.php");
} ?>




  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script/script.js" charset="utf-8"></script>
</body>

</html>
