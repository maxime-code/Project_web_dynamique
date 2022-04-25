<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION['email'])){
    header("Location : authentification.php");
    exit();
 }
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
    <div>
      <h1> Bienvenue <?php echo $_SESSION['email']; ?> ! </h1>
  
        <h1> Prendre un Rendez Vous </h1>
      <form action="" method="post">
        <input type="text" class="form-control" name="medecin" placeholder="Nom du médecin" />
        <input type="text" class="form-control" name="specialite" placeholder "Spécialité" />
        <input type="date" class="form-control" name="date" placeholder="Date" />
        <input type="text" class="form-control" name="codepostal" placeholder="Code Postal" />
        <input type="submit" name="submit" value="Rechercher" class="btn btn-secondary" />
      </form>
  <?php
     $db = dbConnect();
     if(isset($_POST['submit']) {
     if(!isset($_POST['medecin'],$_POST['specialite'], $_POST['date'], $_POST['codepostal'])){
       echo "Veuillez au moins remplir un de ces critères"
       } else {
       if(isset($_POST['medecin']) && !isset($_POST['specialite'], $_POST['date'], $_POST['codepostal'])){
         $statement = $db->prepare("SELECT * FROM medecin WHERE nom=:nom");
         $statement->bindParam(':nom', $_POST['medecin']);
         $statement->execute();
         $result = $statement->fetchAll(PDO::FETCH_ASSOC);
         foreach($result){
           echo "<form action='/Medecin.php' method='get'>";
           echo "Docteur ".$result['nom']." ".$result['prenom']." situé en ".$result['codepostal'].", spécialiste en ".$result['specialite'].";
           echo "<a href='/Medecin.php?email='.$result['email']."'> En Savoir Plus </a>"
           }
       }
       
      <a href = "deconnexion.php"> Déconnexion </a>
    </div>
  </body>
</html>

