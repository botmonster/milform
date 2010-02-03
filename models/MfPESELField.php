<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfInputField.php';

/**
 * Description of PESELField
 *
 * @author botmonster
 */
class MfPESELField extends MfInputField {

   protected $max = 11;
   protected $size = 11;
   protected $class = 'pesel';

   public function validate(){
        $PESEL = $this->value;
        if(strlen($PESEL) == 0)
            return $this;
        $sex = '0';
        if(strlen($PESEL) != 11)
            return $this->markInvalid('PESEL too short');

        $w=array(1,3,7,9);
        for ($i=0;$i<=9;$i++)
        $wk=($wk+$PESEL[$i]*$w[$i % 4]) % 10;
        $k = (10-$wk) % 10;
        if ($PESEL[10]==$k) 
            return $this;
        else 
            return $this->markInvalid('PESEL invalid');

        return $this;
   }

   public function getBirth(){

        $pesel = $this->getValue();

        $year   = (int) substr($pesel, 0, 2);
        $month  = (int) substr($pesel, 2, 2);
        $day    = (int) substr($pesel, 4, 2);

        if($month <= 12)
            $year += 1900;
        elseif($month > 12 && $month <= 32){
            $year += 2000;
            $month -= 20;
        }
        elseif($month > 32 && $month <= 52){
            $year += 2100;
            $month -= 40;
        }
        elseif($month > 52 && $month <= 72){
            $year += 2200;
            $month -= 60;
        }

        $birth = mktime(0, 0, 1, $month, $day, $year);
        $age = date("md") < $month.$day ? date("Y")-$year-1 : date("Y")-$year;

        return array($birth, $age, $pesel[9] % 2 == 0 ? 'f' : 'm');

   }

   public function getDate(){
       
       list($birth) = $this->getBirth();

       return date("d-m-Y", $birth);
   }
   
}

