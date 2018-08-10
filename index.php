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

<?php $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop'); ?>

  <?php if (isset($_POST["Del_client"])) {
  $del_c = $dbh->prepare("DELETE FROM client where id=".$_POST["id_client"]);
  $del_c-> execute();
  } ?>
  <?php if (isset($_POST["Del_entreprise"])) {
  $del_e = $dbh->prepare("DELETE FROM entreprise where id=".$_POST["id_entreprise"]);
  $del_e-> execute();
  } ?>



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

<div class="container"> <!-- DIV CONTAINER -->

  <h1>Listing Clients/Entreprises</h1>

<div class="row">
  <div class="col col-12">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
          <a class="nav-link active" id="pills-clients-tab" data-toggle="pill" href="#pills-clients" role="tab" aria-controls="pills-clients" aria-selected="true">Clients()</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-entreprises-tab" data-toggle="pill" href="#pills-entreprises" role="tab" aria-controls="pills-entreprises" aria-selected="false">Entreprises()</a>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

    <div class="tab-pane fade show active" id="pills-clients" role="tabpanel" aria-labelledby="pills-clients-tab">

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 btn_search" type="submit"><i class="fas fa-search"></i></button>
      <button class="btn btn-outline-success my-2 my-sm-0 btn_delete" type="submit"><i class="fas fa-ban"></i></button>
    </form>

    <div class="accordion" id="accordionClient">

  <?php  foreach($dbh->query('SELECT * from client') as $row) : ?>
      <div class="card">
        <div class="card-header" id="ClientHeading <?php echo $row["id"] ?>">
          <h5 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#Client<?php echo $row["id"] ?>" aria-expanded="true" aria-controls="ClientOne">
            <?php echo $row["prenom"]." ".$row["nom"]; ?>
          </button>
          </h5>
        </div>
        <div id="Client<?php echo $row["id"] ?>" class="collapse" aria-labelledby="ClientHeading<?php echo $row["id"] ?>" data-parent="#accordionClient">
        <div class="card-body">
        <img src="<?php echo $row["photo"] ?>" alt="img_profil">
        <h2><?php echo $row["prenom"]." ".$row["nom"]; ?></h2>

        <form class="" action="index.php" method="post">
          <input type="text" name="id_client" id="id_client" value="<?php echo $row["id"] ?>" hidden>
          <button type="submit" name="Del_client"><i class="fas fa-trash-alt"></i></button>
        </form>

        <form class="" action="editClient.php" method="post">
          <input type="text" name="id_client" id="id_client" value="<?php echo $row["id"] ?>" hidden>
          <button type="submit" name="button"><i class="fas fa-edit"></i></button>
        </form>

        <p><?php echo $row["adresse"]; ?></p>
        <?php $ligne = $dbh->query('SELECT * from entreprise where id='.$row["entreprise_id"])->fetch(); ?>
        <small><a href="#"><?php echo $ligne["nom"]; ?></a></small>
      </div>
    </div>
  </div>
    <?php endforeach; ?>
  </div>
</div>


  <div class="tab-pane fade" id="pills-entreprises" role="tabpanel" aria-labelledby="pills-entreprises-tab">
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

      <button class="btn btn-outline-success my-2 my-sm-0 btn_search" type="submit"><i class="fas fa-search"></i></button>
      <button class="btn btn-outline-success my-2 my-sm-0 btn_delete" type="submit"><i class="fas fa-ban"></i></button>
    </form>

        <div class="accordion" id="accordionEntreprise">
        <?php
        $dbh = new PDO('mysql:host=localhost;dbname=mini-CRM', 'admin', 'plop');
        foreach($dbh->query('SELECT * from entreprise') as $row) : ?>
          <div class="card">
            <div class="card-header" id="EntrepriseHeading <?php echo $row["id"] ?>">
              <h5 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#Entreprise<?php echo $row["id"] ?>" aria-expanded="true" aria-controls="EntrepriseOne">
                <?php echo $row["nom"]; ?>
              </button>
              </h5>
            </div>
            <div id="Entreprise<?php echo $row["id"] ?>" class="collapse" aria-labelledby="EntrepriseHeading<?php echo $row["id"] ?>" data-parent="#accordionEntreprise">
            <div class="card-body">
            <img src="<?php echo $row["photo"] ?>" alt="img_profil">
            <h2><?php echo $row["nom"]; ?></h2>

            <form class="" action="index.php" method="post">
              <input type="text" name="id_entreprise" id="id_entreprise" value="<?php echo $row["id"] ?>" hidden>
              <button type="submit" name="Del_entreprise"><i class="fas fa-trash-alt"></i></button>
            </form>

            <form class="" action="editEntreprise.php" method="post">
              <button type="hidden" name="btnEdit" value="<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></button>
            </form>
            <i class="fas fa-trash-alt"></i>
            <p><?php echo $row["adresse"]; ?></p>
            <?php foreach($dbh->query('SELECT * from client where entreprise_id='.$row["id"]) as $ligne ) : ?>
            <small><a href="#"><?php echo $ligne["nom"]." ".$ligne["prenom"]; ?></a></small><br>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
        <?php endforeach; ?>
        </div>
</div> <!-- div end content tab -->
</div>


</div> <!-- DIV CONTAINER -->




  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script/script.js" charset="utf-8"></script>
</body>

</html>
