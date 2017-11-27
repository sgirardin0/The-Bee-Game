<?php

	class DroneBee extends Bee {
        
        public function __construct() {
        	// On affecte la vie de départ de l'abeille
        	$this->setLife(START_LIFE_DRONE);
        }

        /**
        *@return true si l'abeille est a 0 point de vie sinon false
        */
        public function attack() {
        	$this->setLife($this->getLife()-REMOVE_LIFE_DRONE);
        	echo 'Vous attaquez une abeille drone (- '.REMOVE_LIFE_DRONE.').';
        	if($this->getLife() <= 0) {
        	     return true;
        	}
        	return false;
        }
    }

?>