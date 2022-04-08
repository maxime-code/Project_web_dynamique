<?php
  // Initialiser la session
  session_start();

  // Détruire la sessions.
  if(session_destroy())
  {
    // Redirection vers la page de connexion
    header("Location: authentification.php");
  }
?>
