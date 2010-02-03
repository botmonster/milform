<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
abstract class MfField {

    protected $name;
    protected $value;
    protected $description;
    protected $prefix;
    protected $invalid = false;
    protected $invalidText = "Field required";


    public function   __construct($name, $description, $value = null) {
        
        $this->name             = $name;
        $this->value            = $value;
        $this->description      = $description;
        $this->prefix           = "";
    }

    public function getLabelHTML($lp = ''){
        return $lp.' <label class="'.$this->getName().'" for="'.$this->getName().'">'.$this->getDescription().'</label>';
    }
    
    public function getLabel($lp = ''){
        
        return ($lp ? $lp.' ' : '').$this->description;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getName(){
        return $this->prefix.$this->name;
    }
    
    public function setParent($parent){
        $this->parent = $parent;
        $this->prefix = $this->parent->getName().'_';

        return $this;
    }

    public function fetchValue(&$data){
        if(isset($data[$this->getName()]))
            $this->value =  $this->sanitize($data[$this->getName()]);

        return $this;
    }

    public function setValue($value){
        $this->value = $value;

        return $this;
    }
    
    public function sanitize($value){
        return str_replace('"','',stripslashes(strip_tags($value)));
    }

    public function getValueName(){
        return $this->getValue();
    }

    public function getData(){
        return array($this->getName() => $this->getValueName());
    }

    public function getValueNameNumeric(){

        return preg_replace('/[^0-9]+/','',$this->getValueName());
    }

    public function markInvalid($text = null){
        $this->invalid = true;
        if($text !== null)
            $this->invalidText = $text;

        return $this;
    }

    public function markValid(){
        $this->invalid = false;

        return $this;
    }

    public function getInvalidText(){
        return $this->invalidText;
    }

    public function isValid(){

        return !$this->invalid;
    }

    public function isNull(){
        return ($this->getValue() == null);
    }

    public function markIfNull(){
        
        if($this->isNull())
            $this->markInvalid();

        return $this;
    }

    abstract public function validate();
    abstract public function getHTML();
    abstract public function getValue();
    
}

