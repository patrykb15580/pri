<?php
abstract class Model extends BasicORM
{
    function __construct(Array $attributes = [])
    {
      # first setup default values
      foreach ($this->fields() as $key => $value) {
          $this->$key = $value['default'];
      }

      # assign object attributes/parameters when create
      foreach ($attributes as $key => $value) {
          $this->$key = $value;
      }
    }

    /**
    * Throw exception if property not exist, else set property
    * @param $name
    * @return $value
    */
    public function __set($name, $value)
    {
        # $this = child class form call __set

        # except attributes
        #
        $specialPropertis = ['errors','oryginal_record'];
        if (method_exists($this,'specialPropertis')) {
            $specialPropertis = array_merge($specialPropertis, $this->specialPropertis());
        }

        if ((false === property_exists(get_class($this), $name)) && !in_array($name, $specialPropertis)) {
            throw new Exception(get_class($this)." does not have '".$name."' property.");
        } else {
            $this->$name = $value;
        }
    }

    /**
    * Object is valid
    * @return true/false
    */
    public function isValid()
    {
        # CALLBACK
        if (method_exists($this,'beforeValidate') ) { $this->beforeValidate(); }

        $validation = new Validator($this, $this->validationRules());
        $valid = $validation->valid();
        if ($valid) {
            return true;
        } else {
            #$this->errors = $validation->errors();
            return false;
        }
    }

    /**
    * Extact validation rules form fields array
    * @param $name
    * @return $value
    */
    public function validationRules()
    {
        $rules = [];
        $fields = $this->fields();
        foreach ($fields as $key => $value) {
            if (isset($value['validations'])) {
                $rules[$key] = $value['validations'];
            }
        }
        return $rules;
    }

    /**
    * Chcek if object is new object/record
    * @return true/false
    */
    public function isNewRecord()
    {
        return $this->id == null ? true : false;
    }

    # catch relations methods
    

}
