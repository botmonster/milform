<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfField.php';

/**
 * Description of RadioField
 *
 * @author botmonster
 */ 
class MfRadioField  extends MfField {

    protected $names;

    public function   __construct($name, $description, $names = null, $value = null) {

        parent::__construct($name, $description, $value);
        $this->names = $names;
    }

    public function getHTML(){

        $valid = $this->validate();

        $html = ($valid ? '' : 'złe!');

        foreach($this->names as $lp => $name){
            $html .= '<input type="radio" value="'.$lp.'" name="'.$this->getName().'" id="'.$this->getName().'_'.$lp.'" '.
                     ($this->value != null && $this->value == $lp ? 'checked="checked"' : '').
                     '/> '.
                     '<label for="'.$this->getName().'_'.$lp.'">'.$name.'</label> '.
                     "\n";

        }

        return $html;
   }


   public function validate(){

        return true;
   }

   public function getValue(){

        return $this->value;
   }

   public function getValueName(){
       
        if($this->value === null)
            return '';

        return @$this->names[$this->value];
   }
}

