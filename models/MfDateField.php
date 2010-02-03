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
class MfDateField extends MfInputField {

   protected $max = 10;
   protected $size = 10;
   protected $class = 'date';

   public function validate(){

        if(strlen($this->getValue()) == 0)
            return $this;

        if(!preg_match('/^[0-3][0-9]-([01][0-9])-[12][0-9]{3}$/', $this->getValue()))
            return $this->markInvalid('Format daty nieporpawny');

        return $this;
   }
 
}

