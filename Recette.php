<?php
    class Recette{
        private $titre;
        private $listeIng;
        private $describe;
        private $photo;
        private $tags;

        public function __construct($titre, $listeIng, $describe, $photo, $tags){
            $this->titre=$titre;
            $this->listeIng=$listeIng;
            $this->describe=$describe;
            $this->photo=$photo;
            $this->tags=$tags;
        }
    }
?>