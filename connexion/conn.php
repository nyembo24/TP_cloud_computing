<?php
     class connexion {
        private $host ="localhost";
        private $dbname ="depense";
        private $user ="ny";
        private $pwd ="12345";
        private $con ="";

        public function getconnexion(){
            $this ->con=null;
            try {
                $this->con =new PDO("mysql:host=$this->host;dbname=$this->dbname","$this->user","$this->pwd");
                
            } catch (PDOException $e) {
                die("une erreur s'est produit;".$e->getMessage());
            }
            return $this->con;
        }
     }