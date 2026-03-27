<?php
    class Ingredient{
        // private static $i = 100;
        private $idIng;
        private $nomIng;
        private $imageIng;

        public function __construct($id, $nomIng, $imageIng){
            $this->idIng=$id;
            // $this->i++;
            $this->nomIng=$nomIng;
            $this->imageIng=$imageIng;
        }

        public function getId(){
            return $this->idIng;
        }

        public function getNomIng(){
            return $this->nomIng;
        }

        public function getImage(){
            return $this->imageIng;
        }
    }
?>