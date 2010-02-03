<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */

require_once 'MfGroupField.php';
/**
 * Description of UserGroupField
 *
 * @author botmonster
 */
class MfAggregatedGroup extends MfGroupField{

    public function addField(MfField $field){
  
        $this->fields[] = &$field;

        return $this;
    }

    public function getFields(){
        return $this->fields;
    }

    public function getHTML(){
        
        $html = '';
        foreach($this->fields as $field){
            $html .= $field->getHTML();
        }

        return $html;
    }

    public function getTXT(){

        $html = '';
        foreach($this->fields as $field){
            $html .= $field->getTXT();
        }

        return $html;
    }

    public function get($name) {

        foreach($this->fields as $field){
            try{
                $result = &$field->get($name);
                if($result instanceof MfField)
                    return $result;
            }catch(Exception $e){
                //do nothin'
            }
        }
        throw new Exception($this->getName().": No field found ".$name);
    }
    
    public function getFieldsById($name){
        $fields = new MfAggregatedGroup($name);
        foreach($this->getFields() as $field){
            $fields->addField($field->get($name));
        }

        return $fields;
    }
    
    public function __call($name, $args) {
        $ret = array();
        foreach($this->getFields() as $field){
            $ret[] = $field->$name($args);
        }
        return $ret;
    }

    public function getValue(){
        return $this->__call('getValue', null);
    }

    public function validate(){
        
        foreach($this->fields as $field){
            $field->validate();
        }

        return $this;
    }
}


