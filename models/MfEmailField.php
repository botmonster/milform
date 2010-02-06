<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of EmailField
 *
 * @author botmonster
 */
class MfEmailField extends MfInputField {

   protected $class = 'email';

   public function validate(){
        if(strlen($this->value) > 0 && !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $this->value)){
            return $this->markInvalid('E-mail invalid');
        }

        return $this;
   }

}

