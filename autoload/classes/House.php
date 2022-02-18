<?php

    class House{

        private $street;
        private $number;
        
        public function __construct($street, $number){
            $this->street = $street;
            $this->number = $number;
        }

        public function getHouse(){
            return $this->street . " " . $this->number;
        }
    }

?>