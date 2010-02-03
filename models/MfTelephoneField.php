<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of TelephoneField
 *
 * @author botmonster
 */
class MfTelephoneField extends MfInputField {

   protected $max = 12;
   protected $size = 12;
   protected $class = 'telephone';

   public function validate(){
       if($this->value == null)
        return $this;
       if(!preg_match('/^[+]{0,1}[0-9]{9}/', $this->getValue())){
            return $this->markInvalid('Niepoprawny format');
       }

        return $this;
   }
   
}

