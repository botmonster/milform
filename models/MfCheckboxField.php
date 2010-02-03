<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfRadioField.php';

/**
 * Description of RadioField
 *
 * @author botmonster
 */ 
class MfCheckboxField  extends MfRadioField {


    public function getHTML(){

        $valid = $this->validate();

        $html = ($valid ? '' : 'złe!');

        foreach($this->names as $lp => $name){
            $html .= '<input type="checkbox" value="'.$lp.'" name="'.$this->getName().'" id="'.$this->getName().'_'.$lp.'" '.
                     ($this->value != null && $this->value == $lp ? 'checked="checked"' : '').
                     '/> '.
                     '<label for="'.$this->getName().'_'.$lp.'">'.$name.'</label> '.
                     "\n";

        }

        return $html;
   }
   
   public function isTrue(){

        return $this->value == '0';
   }
}

