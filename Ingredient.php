<?php
    class Ingredient{
        private $idIng;
        private $nomIng;
        private $imageIng;

        public function __construct($idIng, $nomIng, $imageIng){
            $this->idIng = $idIng;
            $this->nomIng = $nomIng;
            $this->imageIng = $imageIng;
        }
        
        // Ajout des getters
        public function getId(){
            return $this->idIng;
        }
        
        public function getNom(){
            return $this->nomIng;
        }
        
        public function getImage(){
            return $this->imageIng;
        }
    }
?>