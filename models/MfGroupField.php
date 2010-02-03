<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */

require_once 'MfField.php';
require_once 'MfTextField.php';
/**
 * Description of GroupField
 *
 * @author botmonster
 */
class MfGroupField extends MfField{

    protected $fields;
    protected $names;

    public function  __construct($fieldName, $fieldDescription = '', $fieldValue = '') {
        
        if($fieldValue == ''){
            $fieldValue = new MfTextField($fieldName.'__','');
        }
        parent::__construct($fieldName, $fieldDescription, $fieldValue);

        $fieldValue->setParent($this)->fetchValue($_POST);
    }

    public function addField(MfField $field){
        if(isset($this->names[$field->name]))
            throw new Exception($this->getName().': Duplicate field ID: '.$field->name);
        $this->names[$field->name] = &$field;
        $this->fields[] = &$field->setParent($this)->fetchValue($_POST);

        return $this;
    }

    public function getFields(){
        return $this->fields;
    }

    public function getHTML(){

        $field = $this->value;
        $html  = $field->getHtml();
        $names = explode('_', $this->getName());
        $name  = 'group'.$this->name.' ';
        foreach($names as $n){
            $name .= 'group'.$n.' ';
        }
        return "<table class='$name'>\n".
               "<tr id='row_".$field->getName()."'>\n".
               "<td class='group ".$this->getName()."' ".(!$html ? "colspan='2'" : '')."> ".$this->getDescription()."</td>\n".
               ($html ? "<td class='values'>".$field->getHtml()."</td>\n" : '').
               "</tr>".
               array_reduce($this->fields, array($this, '_getHTML')).
               "</table>\n";
    }

    public function getHTMLTable($vertical = false){

        return "<table class='$name'>\n".
               "<tr id='row_".$field->getName()."'>\n".
               "<td class='group ".$this->getName()."' ".(!$html ? "colspan='2'" : '')."> ".$this->getDescription()."</td>\n".
               ($html ? "<td class='values'>".$field->getHtml()."</td>\n" : '').
               "</tr>".
               array_reduce($this->fields, array($this, '_getHTML')).
               "</table>\n";
    }

    public function getTXT(){
        
        return "".$this->getName()." ".
               "".
               ($this->getDescription() ? strip_tags($this->getDescription()) : '' ).
               "\n".
               array_reduce($this->fields, array($this, '_getTXT')).
               "\n";
    }

    public function get($name) {
        if($this->value->name == $name)
            return $this->value;
        return @$this->names[$name];
    }

    public function fetchValue(&$data){

        foreach($this->fields as $field){
            $field->fetchValue($data);
        }

        return $this;
    }
    /**
     * Get TXT from fields
     *
     * @param <type> $ret
     * @param <type> $field
     * @return <type>
     */
    private function _getTXT($ret, $field){
        if($field->isNull())
            return $ret;
        return $ret."\t".$field->getDescription().": ".($field->isNull() ? '--------' : $field->getValueName())."\n";
    }
    /**
     * Get HTML from fields
     *
     * @param <type> $ret
     * @param <type> $field
     * @return <type>
     */
    private function _getHTML($ret,MfField $field){

        $html = $field->getHtml();
        $invalid = !$field->isValid();

        return $ret."\n<tr id='row_".$field->getName()."' class='".($invalid ? 'invalid' : '')."'><td>".
               $field->getLabelHTML().
               '<br/><span class="invalidDesc">'.($invalid ? $field->getInvalidText() : '').'</span>'.
               "</td> \n".($html ? "<td class='values'>".$html."</td>\n" : '<td></td>')."</tr>\n";
    }

    public function markFiedlsIfNull(array $names){

        foreach($names as $name){
            $this->get($name)->markIfNull();
        }

        return $this;
    }

    public function isValid(){

        foreach($this->fields as $field){
            if(!$field->isValid())
                return false;
        }

        return true;
    }

    public function getInvalid(){
        $i = array();
        foreach($this->fields as $field){
            if(!$field->isValid())
                $i[] = $field;
        }

        return $i;
    }

    public function getValue(){
        return $this->value;
    }

    public function getData(){
        $ret = array();
        foreach($this->fields as $field){
            $ret = array_merge($ret, $field->getData());
        }
        return $ret;
    }

    public function getAt($num){

        return isset($this->fields[$num]) ? $this->fields[$num] : null;
    }

    public function validate(){}
    public function getFieldHTML(){}
}


