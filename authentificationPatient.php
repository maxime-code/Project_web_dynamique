<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<form action="" method="post">
<h1>Se connecter</h1>
<input type="text" class="form-control" name="email" placeholder="Email" required />
<input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="Se connecter" class="btn btn-secondary" />
</form>
<form action="/inscriptionPatient.php" method="post">
    <p> Pas encore inscrit ?
    <button type="submit">Faites-le ici</button>
</form>
</body>
</html>
