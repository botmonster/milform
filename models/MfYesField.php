<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfYesNoField.php';

/**
 * Description of RadioField
 *
 * @author botmonster
 */
class MfYesField extends MfYesNoField{


    public function   __construct($name, $description, $names = null, $value = null) {

        parent::__construct($name, $description, $names = null, $value = null);
        $this->names = array('Yes');
    }

}

