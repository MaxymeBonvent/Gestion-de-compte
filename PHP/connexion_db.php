<?php
  $conn_str = "host=localhost port=5432 dbname=gestion_de_compte user=postgres password=u1l@DtXC2vn_";
  $db = pg_connect($conn_str);

  // Si la connexion à la DB échoue
  if(!$db)
  {
    // On affiche un message d'erreur
    echo "<body style='background-color: black;'><p style='color: $couleur_txt; text-align: center; font-size: 20px;'>Échec de la connexion à la DB.</p></body>";

    // Fin du script
    exit;
  }
?>