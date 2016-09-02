<?php
class Validator {

  private $errors = [];

  function __construct($obj, $rules) {
    $this->obj = $obj;
    $this->rules  = $rules;
  }

  public function valid() {
    # example rules
    # rules = [
    #   'username' => [
    #       'required',
    #       'max_length:190'
    #   ],
    #   'email' => [
    #       'required',
    #       'email'
    #   ]
    # ]

    foreach ($this->rules as $attribute => $rules) {
      foreach ($rules as $rule) {
        $parts = explode(':', $rule);
        $method = $parts[0];

        if(isset($parts[1])){
          $params = explode(',', $parts[1]);
        } else {
          $params = null;
        }

        $this->{$method}($attribute, $params);
      }
    }

    if (empty($this->errors)) {
      return true;
    }

    # add error to validion object
    $this->obj->errors = $this->errors;
    return false;
  }

  public function errors() {
    return $this->errors;
  }


  # PRIVATE VALID METHODS

  /**
  * Check if attribute is not blank
  * @param $attr
  */
  private function required($attr) {
    if (isset($this->obj->$attr) && trim($this->obj->$attr) !== '') {
      # OK
    } else {
      $this->add_error($attr,  "is required.");
    }
  }

  /**
  * Check lenght of attribute
  * @param $attr
  * @param Array $params
  */
  private function max_length($attr, $params) {
    $max = $params[0];

    # make sure header is correct
    # HTTP-header (Content-Type: text/html; charset=UTF-8)
    if (mb_strlen($this->obj->$attr, 'UTF-8') > $max) {
      $this->add_error($attr, "is too long (max ".$max.").");
    }
  }

  /**
  * Check if email has valid format
  * @param $attr
  */
  private function email($attr) {
    if (ValidateEmail::valid($this->obj->$attr)) {
      # OK
    } else {
      $this->add_error($attr, "email is not valid.");
    }
  }

  /**
  * Check if value is unique
  * @param $attr
  */
  private function unique($attr) {
    $class = get_class($this->obj);
    $items = $class::where($attr.' = ?', [$attr=>$this->obj->$attr]);

    if (!empty($items)){
      if (count($items) == 1 && $items[0]->id == $this->obj->id) {
        # after save object any next validation return false,
        # but this is valid object so we not add error
      } else {
        $this->add_error($attr, "is not unique.");
      }
    }
  }

  /**
  * Check if attribute is allowed value
  * @param $attr
  * @param Array $allow_values
  */
  private function in($attr, $allow_values) {
    if (!in_array($this->obj->$attr, $allow_values)) {
      $this->add_error($attr, "is not allowed value.");
    }
  }

  /**
  * Special validator to use with HasSecurePassword
  * @param $attr
  */
  # TODO move this to HasSecurePassword module
  private function password() {
    # if password_digest contains
    # if value start with error
    if (substr($this->obj->password_digest , 0, 5) == "error") {
      $errors = explode('|', $this->obj->password_digest);
      array_shift($errors); # remove error text
      foreach ($errors as $value) {
       $this->add_error('password', $value);
      }
    }
  }


  # PRIVATE METHODS

  private function add_error($attr, $error) {
    if (!isset($this->errors[$attr]))
      $this->errors[$attr] = [];

    $this->errors[$attr][] = $error;
  }

}
