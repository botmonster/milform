<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of DateField
 *
 * @author botmonster
 */
class MfSmallNumField extends MfInputField {

   protected $max = 3;
   protected $size = 3;
   protected $class = 'smallnum';

   public function validate(){
       if($this->value == null)
        return $this;
       if(!preg_match('/^[+\-]{0,1}[0-9]{1,3}$/', $this->getValue())){
            return $this->markInvalid('Niepoprawny format');
       }

        return $this;
   }
   
}

