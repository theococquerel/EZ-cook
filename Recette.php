<?php
    class Recette{
        private $id;
        private $titre;
        private $listeIng;
        private $describe;
        private $photo;
        private $tags;

        public function __construct($id ,$titre, $listeIdIng, $describe, $photo, $tags){
            $this->$id = $id;
            $this->titre=$titre;
            $this->listeIdIng=$listeIdIng;
            $this->describe=$describe;
            $this->photo=$photo;
            $this->tags=$tags;
        }

        public function getId(){
            return $this->id;
        }

        public function getTitre(){
            return $this->titre;
        }

        public function getListeIdIng(){
            return $this->listeIdIng;
        }

        public function getDescribe(){
            return $this->describe;
        }

        public function getPhoto(){
            return $this->photo;
        }
        
        public function getListTag(){
            return $this->tags;
        }
    }
?>