<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of AreaCodeField
 *
 * @author botmonster
 */
class MfAreaCodeField extends MfInputField {

   public function getHTML(){

       $valid = $this->validate();
       list($a, $b) = explode('-',$this->getValue());

       return '<input type="text" maxlength="2" size="2" class="area_code_0" '.
              ' id="'.$this->getName().
              '_0" name="'.$this->getName().'_0" value="'.$a.'" />-'.
              '<input type="text" maxlength="3" size="3" class="area_code_1" '.
              ' id="'.$this->getName().
              '_1" name="'.$this->getName().'_1" value="'.$b.'" />';
   }

   public function fetchValue(&$data){

      if(!isset($data[$this->getName().'_0']) || !isset($data[$this->getName().'_1']))
        return $this;

      $this->value = $this->sanitize($data[$this->getName().'_0'].'-'.$data[$this->getName().'_1']);
      if($this->value == '-')
        $this->value = null;
      
      return $this;
   }

   public function validate(){

        if(strlen($this->getValue()) == 0)
            return $this;
        if(!preg_match('/^[0-9]{2}\-[0-9]{3}$/', $this->getValue())){
            return $this->markInvalid('Kod pocztowy nieporpawny');
        }

        return $this;
   }
   
}

