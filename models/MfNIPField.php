<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of NIPField
 *
 * @author botmonster
 */
class MfNIPField extends MfInputField {

   protected $max = 10;
   protected $size = 10;
   protected $class = 'nip';

   public function validate(){

       if(strlen($this->value) == 0)
        return $this;
       if(!preg_match('/^[0-9]{10}/', $this->value))
        return $this->markInvalid('NIP invalid');

	$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
	$intSum=0;
	for ($i = 0; $i < 9; $i++)
	{
		$intSum += $arrSteps[$i] * $this->value[$i];
	}
	$int = $intSum % 11;

	$intControlNr=($int == 10)?0:$int;
	if ($intControlNr == $str[9])
	{
		return $this;
	}
	return $this->markInvalid('NIP invalid');
   }
}

