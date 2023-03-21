<?php
// Tableau contenant les tâches à faire
$taches = array(
  "PHP 8.1",
  "Composer",
  "Git",
  "MySQL ou similaire"
);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Les pré-requis</title>
</head>
<body>

	<style type="text/css">
		.text-lg {
			font-size: 22px;
		}
		body {
			height: 80vh;
			justify-content: center;
			align-items: center;
		}
	</style>

  <h1 class="text-lg">Pré-requis</h1>

  <ul>
    <?php
    // Boucle qui affiche chaque tâche dans une liste HTML
    foreach ($taches as $tache) {
      echo "<li>" . $tache . "</li>";
    }
    ?>
  </ul>

</body>
</html>
