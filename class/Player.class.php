<?php

    class Player {

        private $bee;

        public function __construct() {
        	// On initialise toute les abeilles au début de la partie
        	$this->initBee();
        }

        /* Initialisation des abeilles */
        public function initBee() {
        	if(isset($this->bee)) unset($this->bee);
        	for($i = 0; $i < NBR_QUEEN; $i++) {
        	    $this->bee['queen'][] = new QueenBee();
        	}
        	for($i = 0; $i < NBR_WORKER; $i++) {
        	    $this->bee['worker'][] = new WorkerBee();
        	}
        	for($i = 0; $i < NBR_DRONE; $i++) {
        	    $this->bee['drone'][] = new DroneBee();
        	}
        }

        /**
        *@return un tableau de abeilles rennes ou false si il n'y en a aucune 
        */
        public function getQueenBee() {
        	return isset($this->bee['queen']) ? $this->bee['queen'] : false;
        }

        /**
        *@return un tableau de abeilles travailleuse ou false si il n'y en a aucune 
        */
        public function getWorkerBee() {
        	return isset($this->bee['worker']) ? $this->bee['worker'] : false;
        }

        /**
        *@return un tableau de abeilles drone ou false si il n'y en a aucune 
        */
        public function getDroneBee() {
        	return isset($this->bee['drone']) ? $this->bee['drone'] : false;
        }

        /* Attaquer une abeille random */
        public function attackBee() {
            $keyType = array_rand($this->bee);  			// Sélection random d'un type d'abeille (queen, worker, drone)
            $keyBee = array_rand($this->bee[$keyType]);		// Sélection random d'une abeille 
           
            if($this->bee[$keyType][$keyBee]->attack()) {
            	unset($this->bee[$keyType][$keyBee]);
            	if($keyType == 'queen' && count($this->bee[$keyType]) <= 0) {    // Si la renne est à 0 point de vie on réinitialise la partie
            		 echo '<br />La renne est à 0 point de vie.';
            		 $this->resetGame();
            	}	
            }
            if(count($this->bee[$keyType]) <= 0) unset($this->bee[$keyType]);   
        }

        /* Réinitialiser la partie */
        public function resetGame() {
            $this->initBee();
            echo '<br /><b>La partie a été réinitialisé.</b>';
        }
    }

?>