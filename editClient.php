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

<h1>EDIT CLIENT</h1>
<?php $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop');?>

<?php if (isset($_POST['submit'])) {

    $lineADD = $dbh->prepare("UPDATE client SET  nom=:nom , prenom=:prenom , adresse=:adresse, entreprise_id=:entreprise_id where id=:id");
    $lineADD->bindParam(':nom', $_POST["nom"]);
    $lineADD->bindParam(':prenom', $_POST["prenom"]);
    $lineADD->bindParam(':adresse', $_POST["adresse"]);
    $lineADD->bindParam(':entreprise_id', $_POST["entreprise_id"]);
    $lineADD->bindParam(':id', $_POST["client_id"]);
    $lineADD->execute();

    header("Location: http://minicrm-php/index.php");

} else { ?>
<?php $client = $dbh->query('SELECT * from client where id='.$_POST["id_client"])->fetch(); ?>

<form class="" action="editClient.php" method="post">
  <?php echo $client["id"] ?>
  <input type="text" name="client_id" value="<?php echo $client["id"] ?>" hidden>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNom">Nom</label>
      <input type="text" class="form-control" id="nom" value="<?php echo $client["nom"] ?>" name="nom" placeholder="Nom">

    </div>
    <div class="form-group col-md-6">
      <label for="inputPrenom">Prénom</label>
      <input type="text" class="form-control" name="prenom" value="<?php echo $client["prenom"] ?>" id="inputPrenom" placeholder="Prénom">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAdresse">Addresse</label>
    <input type="text" class="form-control" id="inputAdresse" name="adresse" value="<?php echo $client["adresse"] ?>" placeholder="1234 Main St">
  </div>
    <div class="form-group col-md-4">
      <label for="inputEntreprise">Entreprise</label>
      <select id="inputEntreprise" name="entreprise_id" class="form-control">*
        <?php foreach($dbh->query('SELECT * from entreprise') as $row) : ?>
            <?php if ($row['id'] == $client["entreprise_id"])  { ?>
              <option selected value="<?php echo $client["entreprise_id"] ?>"><?php echo $row['nom'] ?></option>
            <?php } else { ?>
              <option value='<?php echo $row['id'] ?>'> <?php echo $row['nom'] ?></option>
            <?php } ?>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Edit</button>
</form>

<?php } ?>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script/script.js" charset="utf-8"></script>
</body>

</html>
