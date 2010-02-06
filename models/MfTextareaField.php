<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfField.php';

/**
 * Description of TextareaField
 *
 * @author botmonster
 */
class MfTextareaField extends MfField {

   protected $max;
   protected $size;
   protected $class = 'textareaField';

   public function getHTML(){
       $valid = $this->validate();
       
       return '<textarea '.($this->max ? "maxlength='{$this->max}'" : '').
              ' id="'.$this->getName().'"'.
              ($this->size ? ' size="'.$this->size.'" ' : ' style="width: 100%;" ').
              ($this->class ? ' class="'.$this->class.'" ' : ' ').
              ' name="'.$this->getName().'">'.$this->getValue().'</textarea>';
   }


   public function validate(){

        return $this;
   }

   public function getValue(){
       
    return $this->value;
   }



   
}

