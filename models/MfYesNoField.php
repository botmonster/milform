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
class MfYesNoField extends MfRadioField{

    protected $names;

    public function   __construct($name, $description, $value = null) {

        parent::__construct($name, $description, array('Yes', 'No'), $value);
    }

   
    public function isTrue(){

        return $this->value == '0';
    }
}

