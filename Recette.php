<?php
    class Recette{
        private $id;
        private $titre;
        private $listeIdIng;
        private $describe;
        private $photo;
        private $tags;

        public function __construct($id ,$titre, array $listeIdIng, $describe, $photo, array $tags){
            $this->id = $id;
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

        public function getListeIdIng(): array{
            return $this->listeIdIng;
        }

        public function getDescribe(){
            return $this->describe;
        }

        public function getPhoto(){
            return $this->photo;
        }
        
        public function getListTag(): array{
            return $this->tags;
        }
    }
?>