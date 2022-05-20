
<?php
  include ("database.php");

  ini_set('display_errors',1);
  error_reporting(E_ALL);
  dbConnect();
  $db = dbConnect();
  session_start();


  if(isset($_POST['submit']) && !empty($_POST['submit']))
  {
    $request = 'SELECT email, mdp FROM medecin WHERE email=:email AND mdp=:mdp';
    $statement = $db->prepare($request);
    $statement->bindParam(':email', $_POST['email']);
    $statement->bindParam(':mdp',$_POST['password']);
    $statement->execute();
    $result = $statement->fetch();
    $row = $statement->rowCount();
    if($row == 1)
    {
      $_SESSION['email'] = $result['email'];
      header("Location: medecin.php");
    }else{
        $erreur = "Vos identifiants sont incorrect ou n'existent pas.";
    }  
}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title> Inscription Patient </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/heroes/">

    

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="heroes.css" rel="stylesheet">
  </head>
  <body>
    
<main>

  <div class="b-example-divider"></div>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        
      <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="post">
        <h1 class="text-center"> Authentification Medecin </h1>
        <br>
          <?php if (! empty($erreur)) { ?>
            <div class="alert alert-danger">
              <strong> <?php echo $erreur; ?> </strong>
            </div>
          <?php } ?>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Adresse mail</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Mot de passe</label>
          </div>
          <br>
          <input class="w-100 btn btn-lg btn-primary" name="submit" type="submit" value="Se connecter">
          <hr class="my-4">

          <div class="row">
          <div class="col-sm">
          <button class="w-100 btn btn-lg btn-outline-secondary" onclick="window.location.href = 'inscriptionMedecin.php';"> S'inscrire </button>
            </div>
          <div class="col-sm">
           <button class="w-100 btn btn-lg btn-outline-secondary" onclick="window.location.href = 'accueil.php';"> Accueil </button>
          </div>
          </div>
        
        </form>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <img src="image/Jojo.png" class="d-block mx-lg-auto img-fluid" width="100%" height="100%" loading="lazy">
      </div>
    </div>
  </div>

  <div class="b-example-divider mb-0"></div>
</main>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

      
  </body>
</html>
