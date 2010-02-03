<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfField.php';

/**
 * Description of InputField
 *
 * @author botmonster
 */
class MfInputField extends MfField {

   protected $max;
   protected $size;
   protected $class = 'textField';

   public function getHTML(){
       $valid = $this->validate();
       
       return '<input type="text" '.($this->max ? "maxlength='{$this->max}'" : '').
              ' id="'.$this->getName().'"'.
              ($this->size ? ' size="'.$this->size.'" ' : ' style="width: 100%;" ').
              ($this->class ? ' class="'.$this->class.'" ' : ' ').
              ' name="'.$this->getName().'" value="'.$this->getValue().'" />';
   }


   public function validate(){

        return $this;
   }

   public function getValue(){
       
    return $this->value;
   }



   
}

