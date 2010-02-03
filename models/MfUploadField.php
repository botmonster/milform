<?php
/*
 * Przemek Łącki <przemek@7items.com>
 * (c) 2010 7items.net
 */
require_once 'MfField.php';

/**
 * Description of UploadField
 *
 * @author botmonster
 */
class MfUploadField extends MfField {

   protected $max;
   protected $size;
   protected $class = 'upload';

   public function getHTML(){
       $valid = $this->validate();
       
       return '<input type="file" '.($this->max ? "maxlength='{$this->max}'" : '').
              ' id="'.$this->getName().'"'.
              ($this->size ? ' size="'.$this->size.'" ' : ' style="width: 100%;" ').
              ($this->class ? ' class="'.$this->class.'" ' : ' ').
              ' name="'.$this->getName().'" value="'.$this->getValue().'" />';
   }


   public function validate(){

        return true;
   }

   public function getValue(){
       
    return $this->value;
   }

   public function isUploaded(){

       return isset($_FILES[$this->getName()]);
   }

   public function saveAs($name){
       if(!$this->isUploaded())
        return false;

       return move_uploaded_file($_FILES[$this->getName()]['tmp_name'], $name);
   }
   
}

