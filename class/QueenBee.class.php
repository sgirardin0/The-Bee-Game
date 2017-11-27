<?php

	class QueenBee extends Bee {
	    
	    public function __construct() {
	    	// On affecte la vie de départ de l'abeille
	    	$this->setLife(START_LIFE_QUEEN);
	    }

	    /**
        *@return true si l'abeille est a 0 point de vie sinon false
        */
	    public function attack() {
        	$this->setLife($this->getLife()-REMOVE_LIFE_QUEEN);
        	echo 'Vous attaquez une abeille renne (- '.REMOVE_LIFE_QUEEN.').';
        	if($this->getLife() <= 0) {
        	     return true;
        	}
        	return false;
        }
	}

?>