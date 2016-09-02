<?php
abstract class Model extends BasicORM {

  function __construct(Array $attributes = []) {

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
  public function __set($name, $value) {
    # $this = child class form call __set

    # except attributes
    #
    $special_propertis = ['errors','oryginal_record'];
    if ( method_exists($this,'special_propertis')) {
      $special_propertis = array_merge($special_propertis, $this->special_propertis());
    }

    if ((false === property_exists(get_class($this), $name)) && !in_array($name, $special_propertis)) {
      throw new Exception(get_class($this)." does not have '".$name."' property.");
    } else {
      $this->$name = $value;
    }
  }

  /**
  * Object is valid
  * @return true/false
  */
  public function is_valid() {
    # CALLBACK
    if ( method_exists($this,'before_validate') ) { $this->before_validate(); }

    $validation = new Validator($this, $this->validation_rules());
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
  public function validation_rules() {
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
  public function is_new_record() {
    return $this->id == null ? true : false;
  }

}
