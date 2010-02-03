<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfField.php';

/**
 * Description of TextField
 *
 * @author botmonster
 */
class MfTextField extends MfField {

   public function getHTML(){

       return $this->getValue();


   }

   public function validate(){

        return true;
   }

   public function getValue(){
       
    return $this->value;
   }
}

