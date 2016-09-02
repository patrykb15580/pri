<?php
abstract class BasicORM {

  private static $query = null;
  private static $class = null;
  private static $table = null;

  /**
  * Get all records from database
  * @return array of objects
  */
  public static function all(Array $params=[]) {
    $objects = self::where('', [], $params); # if none params na query the grab all
    return $objects;
  }

  /**
  * Get record from database base on id
  * @param Integer $id
  * @return object
  */
  public static function find($id, Array $params=[]) {
    $params['limit'] = 1;
    $object = self::where('id = ?', ['id'=>$id], $params);
    if (empty($object)) {
      throw new Exception('Couldn\'t find '.self::$class.' with id='.$id, 404);
    } else {
      return $object[0]; # return single object, not array of one object
    }
  }

  /**
  * Get record by field
  * @param String $attribute
  * @param String $value
  * @return Array of objects
  */
  public static function find_by($attribute, $value, Array $params=[]) {
    $params['limit'] = 1;
    $object = self::where($attribute.' = ?', [$attribute=>$value], $params);
    if (empty($object))
      return null;
    else
      return $object[0]; # return single object, not array of one object
  }

  /**
  * Get record by field
  * @param String $query
  * @param Array $fileds
  * @return Array of objects
  */
  public static function where($query, Array $fileds, Array $params=[]) {
    $extra_params = self::extra_params($params);
    self::$class = get_called_class();
    self::$table = strtolower(self::$class);

    $q = "SELECT `".self::$table."`.* FROM `".self::$table."`";
    if ($query != '')
      $q .= " WHERE ".$query;
    $q .= $extra_params;

    self::$query = MyDB::db()->prepare($q);

    self::bind_params($fileds);
    $objects = self::run_query_get_results_objects();
    return $objects;
  }

  /**
  * Get first record
  * @param Array $params
  * @return object
  */
  public static function first(Array $params=[]) {
    $params['limit'] = 1;
    $object = self::where('', [], $params);
    if (empty($object))
      return null;
    else
      return $object[0]; # return single object, not array of one object
  }

  /**
  * Get last record
  * @param Array $params
  * @return object
  */
  public static function last(Array $params=[]) {
    $params['limit'] = 1;
    $params['order'] = 'id DESC';
    $object = self::where('', [], $params);
    if (empty($object))
      return null;
    else
      return $object[0]; # return single object, not array of one object
  }

  /**
  * Qustom sql query
  * @param Array $params
  * @return object
  */
  public static function sql($query, Array $fileds, Array $params=[]) {
    $extra_params = self::extra_params($params);
    self::$class = get_called_class();
    self::$table = strtolower(self::$class);

    self::$query = MyDB::db()->prepare($sql);
    self::bind_params($fileds);
    $objects = self::run_query_get_results_objects();


    return $objects;
  }


  public function save() {
    # exit if not valid
    if (!$this->is_valid()) { return false; }

    $class = get_called_class();
    $table = strtolower($class);

    $db_obj = self::create_db_object($this);
    $db_obj = self::set_timestamps($this, $db_obj);

    # buldit query
    if ($this->is_new_record()) {
      # save

      # obj => "`name`, `name_search`, `created_at`, `updated_at`"
      $parameters = ObjectUntils::mysql_parameters($db_obj);
      # obj => "?, ?, ?, ..."
      $parameters_values_placeholder = ObjectUntils::mysql_parameters_values_placeholder($db_obj);
      $query = MyDB::db()->prepare("INSERT INTO `".$table."` (". $parameters .") VALUES (". $parameters_values_placeholder . ")");

    } else {
      #update
      #"UPDATE MyGuests SET lastname='Doe' WHERE id=2"
      $parameters = ObjectUntils::mysql_parameters_update($db_obj);
      $query = MyDB::db()->prepare("UPDATE `".$table."` SET ".$parameters." WHERE `id`=?");
    }

    if (!$query) {
      // handle error
      die("Złe zapytanie");
      # TODO log this to file
    }

    # CALLBACK
    if ( method_exists($this,'before_save') ) { $this->before_save(); }

    # buldit bind params
    $type = [];
    $data = [];
    foreach ($db_obj as $param => $value) {
      # i 	corresponding variable has type integer
      # d 	corresponding variable has type double
      # s 	corresponding variable has type string
      # b 	corresponding variable is a blob and will be sent in packets
      $t = 's';
      if ($this->fields()[$param] == 'integer') { $t = 'i'; }
      if ($this->fields()[$param] == 'float') { $t = 'd'; }
      if ($this->fields()[$param] == 'double') { $t = 'd'; }
      if ($this->fields()[$param] == 'blob') { $t = 'b'; }
      $type[] = $t;

      $data[] = '$db_obj->'.$param;
    }

    # jesli edycja, poza polami ktore sie zmieniły, musimy dodac id rekordu
    if (!$this->is_new_record()) {
       $type[] = 'i';
       $data[] = '$this->id';
    }

    # bind params
    $sql_stmt = '$query->bind_param(\'' . implode('',$type) . '\', ' . implode(', ',$data) . ');'; // put bind_param line together

    eval($sql_stmt); // execute bind_param

    if (!$query->execute()) {
      // handle error
      die(print_r($query));
      # TODO log this to file
      return false;
    } else {
      if ($this->is_new_record()) {
        # get id created record
        $this->id = $query->insert_id;
      }

      # pobierz nowy rekord i zaktualizuj dane obecnego obiektu
      $class = get_class($this);
      $new_record = $class::find($this->id);
      foreach ($new_record as $key => $value) {
        $this->$key = $value;
      }

      # CALLBACK
      if ( method_exists($this,'after_save') ) { $this->after_save(); }

      return true;
    }
  }

  public function update(Array $attributes) {
    # sprawdz czy atrybuty istnieja i sa dozowalne
    $allowed_attributes = $this->fields();
    foreach ($attributes as $key => $value) {
      if (!array_key_exists($key, $allowed_attributes)) {
        echo Response::raise_error(400, ['Niedozwolony parametr']);
        die();
      }
    }

    # aktaualizauj obiekt
    foreach ($attributes as $key => $value) {
      $this->$key = $value;
    }

    # save
    # return to return object or false
    return $this->save();
  }

  public function destroy() {
    if (!isset($this->id)) {
      die("Obiekt nie został zapisany w bazie danych, więc nie mozna go usunąć.");
    }

    $class = get_called_class();
    $table = strtolower($class);

    $query = MyDB::db()->prepare("DELETE FROM `".$table."` WHERE `id` = ?");
    # bind params
    $query->bind_param("i", $this->id);

    if (!$query->execute()) {
      // handle error
      die(print_r($query));
      # TODO log this to file
      return false;
    } else {

      return true;
    }
  }

  # $query_params
  # ['id'=>$id]
  # ['name'=>$name', role'=>$role]
  # budowanie funkcji bind_param na bazie tablicy
  # uzywamy bind_param ze wzgledów bezpieczenstwa
  public static function bind_params(Array $query_params = []) {
    if (!self::$query) {
      throw new Exception("Wrong query");
    }

    if (!empty($query_params)) {
      # get model attributes
      $class_obj = (new self::$class)->fields();
      $obj = new stdClass();

      # buldit bind params
      $type = [];
      $data = [];
      foreach ($query_params as $param => $value) {
        # i 	corresponding variable has type integer
        # d 	corresponding variable has type double
        # s 	corresponding variable has type string
        # b 	corresponding variable is a blob and will be sent in packets
        $t = 's';
        if ($class_obj[$param]['type'] == 'text') { $t = 's'; }
        if ($class_obj[$param]['type'] == 'integer') { $t = 'i'; }
        if ($class_obj[$param]['type'] == 'datetime') { $t = 's'; }
        if ($class_obj[$param]['type'] == 'float') { $t = 'd'; }
        if ($class_obj[$param]['type'] == 'double') { $t = 'd'; }
        if ($class_obj[$param]['type'] == 'blob') { $t = 'b'; }
        $type[] = $t;
        $data[] = '$query_params[\''.$param.'\']';
      }

      # bind params
      $sql_stmt = 'self::$query->bind_param(\'' . implode('',$type) . '\', ' . implode(', ',$data) . ');'; // put bind_param line together

      eval($sql_stmt); // execute bind_param
    }
  }

  public static function run_query_get_results_objects() {
    self::$query->execute();
    $result = self::$query->get_result();

    # create new object
    $objects = self::create_objects($result);

    self::$query->free_result();
    return $objects;
  }

  # create new object used to buldit query
  # filter object attributes, leave only present and database exist params
  public static function create_db_object($that) {
    $db_obj = new stdClass();
    if ($that->is_new_record()) {
      foreach ($that->fields() as $attr => $type) {
        if ($that->$attr !== null) {
          $db_obj->$attr = $that->$attr;
        }
      }
    } else {
      # w obiekcie zapisujemy tylko te pola ktore sie zmieniły
      # zakladamy ze w oryginal_record nie bedzie parametrów ktorychnie ma
      # zadeklarowanych w modelu, dlatego nie sprawdzamy czy atrybit jest
      # w $that->fields()

      foreach ($that->oryginal_record as $attr => $val) {
        if ($val != $that->$attr)
          $db_obj->{$attr} = $that->$attr;
      }
    }
    return $db_obj;
  }

  public static function set_timestamps($that, $obj) {

    if ($that->is_new_record()) {
      # set created_at time stamp
      if (!isset($obj->created_at)) {
        $obj->created_at = date(Config::get('mysqltime'));
      }
    }

    # actualize updated_at time
    $obj->updated_at = date(Config::get('mysqltime'));

    return $obj;
  }

  # PRIVATE

  # zamiana kazdego rekordu z bazy danych na obiekt o klasie z ktorej zostal wywolany
  # TODO chyba powinno tworzyc obiekty na bazie tabeli z jakiej zostało pobrane
  public static function create_objects($result) {
    $class = get_called_class();
    $objects = [];

    while ($row = $result->fetch_assoc()) { # only return one row each time it is called
      $obj = new $class;

      foreach ($row  as $key => $value)
        $obj->$key = $value;

      # if field is text type then hash
      # ale poki co nie mam co sie przejmowac wydajnoscia
      # ObjectUntils {to_array
      $oryg = clone $obj;
      $obj->oryginal_record = [];

      foreach ($oryg as $key => $value)
        $obj->oryginal_record[$key] = $value;

      unset($obj->oryginal_record['created_at']);
      unset($obj->oryginal_record['updated_at']);

      $objects[] = $obj;
    }

    return $objects;
  }

  # ORDER i LIMIT dodawane na koncu zapytania mysql
  public static function extra_params(Array $params) {
    $sql = '';

    # ORDER
    # example ['order'=>'created_at DESC']
    if (isset($params['order'])) {
      $sql .= ' ORDER BY '.$params['order'];
    }

    # LIMIT ['limit'=>10, 'page'=>2]
    if (isset($params['limit'])) {
      $page = (int) ($p = $params['page'] ?? 1);
      $limit = $params['limit'];
      $startpoint = ($page * $limit) - $limit;
      $sql .= ' LIMIT '.$startpoint.', '.$limit;
    }

    return $sql;
  }

}
