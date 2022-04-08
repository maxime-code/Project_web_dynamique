// page qui vous envoie votre mot de passe par mail

<!DOCTYPE html>
<html>
<head>
  <title> Mot de passe oublié </title>
  // On ajoute Boostrap
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    </head>
    <body>
        <div>Mot de passe oublié</div>
        <form action="" method="post">
           <?php
                if (isset($mail)){
            ?>
                <div><?= $mail ?></div>
            <?php   
                }
            ?>
            <input type="email" class="form-control" placeholder="email" name="email" required>
            <button type="submit" class="btn btn-secondary" name="reset"> Envoyer </button>
        </form>
    </body>
</html>
<php
     include("database.php");
     $db = dbConnect();
if (isset($_POST['reset'])){
            $mail = htmlentities(strtolower(trim($email)));

            if(empty($mail)){
                $valid = false;
                $mail = "Veuillez mettre un mail";
            }
 
            if($valid){
                $statement = $db->query("SELECT nom, prenom, email, mdp FROM medecin WHERE email = :email";
                $statement = bindParam(':email', $_POST['email']);
                $statement->execute();
                $result = $statement->fetch();
 
                if(isset($result['email'])){
                        $objet = 'Votre mot de passe';
                        $to = $result['mail'];
 
                        //===== Création du header du mail.
                        $header = "From: NOM_DE_LA_PERSONNE <no-reply@test.com> \n";
                        $header .= "Reply-To: ".$to."\n";
                        $header .= "MIME-version: 1.0\n";
                        $header .= "Content-type: text/html; charset=utf-8\n";
                        $header .= "Content-Transfer-Encoding: 8bit";
 
                        //===== Contenu de votre message
                        $contenu =  "<html>".
                            "<body>".
                            "<p style='text-align: center; font-size: 18px'><b>Bonjour Mr, Mme".$result['nom']."</b>,</p><br/>".
                            "<p style='text-align: justify'><i><b>Votre mot de passe : </b></i>".$result['mdp']."</p><br/>".
                            "</body>".
                            "</html>";
                        //===== Envoi du mail
                        mail($to, $objet, $contenu, $header);
                    }   
                }       
                header('Location: connexion.php');
                exit;
            }
        }
    }
?>
