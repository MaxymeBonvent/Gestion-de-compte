<?php
  $conn_str = "host=localhost port=5432 dbname=gestion_de_compte user=postgres password=u1l@DtXC2vn_";
  $db = pg_connect($conn_str);

  // Si la connexion à la DB échoue
  if(!$db)
  {
    // On affiche un message d'erreur
    echo "<p>Échec de la connexion à la base de données.</p>";

    // Fin du script
    exit;
  }
?>