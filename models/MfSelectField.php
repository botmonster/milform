<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfRadioField.php';

/**
 * Description of SelectField
 *
 * @author Przemek Łącki
 */ 
class MfSelectField  extends MfRadioField {

    public function getHTML(){

        $html = '<select name="'.$this->getName().'" id="'.$this->getName().'" >';

        foreach($this->names as $lp => $name){
            $html .= "<option value='$lp' ".($this->value != null && $this->value == $lp ? 'selected' : '').">$name</option>";
        }
        
        $html .= '</select>';
        
        return $html;
   }

}

