[Milform](http://7items.net/milform/) - Fast PHP forms creation
===============================================================

About
-----
Milform is free php library (MIT licence) for easy form creation. It is based on form object models and fully supports PHP5 language.

Example
-------
```php
<?php
    $groupA = new MfGroupField('A', 'Personal information');
        $groupA
        ->addField(new MfInputField('name','Name'))
        ->addField(new MfEmailField('email','Email'))
        ->addField(new MfDateField('birthday','Birthday'))
        ->addField(new MfCheckboxField('fav_place','Favourite place', array('Paris', 'Rome', 'London')))
        ->addField(new MfRadioField('fav_color','Favourite color', array('red', 'black', 'green')))
        ->addField(new MfSelectField('fav_shape','Favourite shape', array('spades', 'diamond', 'clovers', 'hearts')))
        ->addField(new MfYesNoField('like_ice_cream','Like ice cream'))
        ->addField(new MfYesField('like_ice_milk','Like milk'))
    ;

    class MyValidator extends MfAggregatedGroup
    {
        public function validate(){

            $this->markFiedlsIfNull(array('name','email','fav_place','fav_color'));
            if($this->get('fav_place')->getValueName() != "London")
                $this->get('fav_place')->markInvalid("Should be London :(");

            return parent::validate();
        }
    }

    if(isset($_POST['submit'])){
        $myV = new MyValidator('Simple validation');
        $result = $myV->addField($groupA)->validate()->isValid() ? 'OK' : 'Far from OK!';
    }

    echo $groupA->getHTML();
```
More
----
More advanced examples at: [http://7items.net/milform/](http://7items.net/milform/)