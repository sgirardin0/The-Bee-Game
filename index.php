 <?php
 	 session_start();

     require_once 'inc/config.php';

     // On charge toute les classes
     spl_autoload_register(function ($class_name) {
	     include 'class/'. $class_name . '.class.php';
	 });


 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>The Bee Game</title>
	</head>
	<body>
	    <form method="POST" action="index.php">
	    	<input type="submit" name="post_attack_bee" value="Attaquer" />
	    	<input type="submit" name="post_reset_game" value="Reset" />
	    </form>
	    <br />
	    <?php

	        // Affichage du message si présent dans le GET
	    	if(count($_GET)) {
	    		if(isset($_GET['m'])) echo $_GET['m'];
	    	}

		    // On créé la partie si elle n'est pas déjà instancié
		    if(!isset($_SESSION['player'])) {
		    	$_SESSION['player'] = serialize(new Player());
		    }

		    $player = unserialize($_SESSION['player']);

		    // Gestion du post
		    if(count($_POST)) {

		        if(isset($_POST['post_attack_bee'])) {    // Attaquer une abeille random
		            $player->attackBee();
		        }

		        if(isset($_POST['post_reset_game'])) {    // Réinitialiser la partie
		            session_destroy();
		            header('location: index.php?m=Vous avez réinitialisé la partie.');
		            exit;
		        }

		    }

			// On affiche toute les abeilles   
			$tmp = $player->getQueenBee();
			if($tmp !== false) {
			    echo '<ul>';
			    foreach ($tmp as $key => $value) {
			    	echo '<li>Queen : '.$value->getLife().'</li>';
			    }
			    echo '</ul>';
			}

		    $tmp = $player->getWorkerBee();
			if($tmp !== false) {
			    echo '<ul>';
			    foreach ($tmp as $key => $value) {
			    	echo '<li>Worker : '.$value->getLife().'</li>';
			    }
			    echo '</ul>';
			}

			$tmp = $player->getDroneBee();
			if($tmp !== false) {
			    echo '<ul>';
			    foreach ($tmp as $key => $value) {
			    	echo '<li>Drone : '.$value->getLife().'</li>';
			    }
			    echo '</ul>';
			}

		    // On sauvegarde la partie 
		    $_SESSION['player'] = serialize($player)

	    ?>

	   
		
	</body>
</html>